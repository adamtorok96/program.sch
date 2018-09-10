<?php


namespace App\Managers;


use App\Models\Circle;
use App\Models\Poster;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Storage;

class ProgramsManager
{
    /**
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    protected $storage;

    /**
     * @var $program Program
     */
    protected $program = null;

    /**
     * @var null|Circle
     */
    protected $circle = null;

    /**
     * ProgramsManager constructor.
     */
    public function __construct()
    {
        $this->storage = Storage::disk('posters');
    }

    /**
     * @param Program $program
     * @return $this
     */
    public function setProgram(Program $program)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * @param Circle $circle
     * @return $this
     */
    public function setCircle(Circle $circle)
    {
        $this->circle = $circle;

        return $this;
    }

    /**
     * @param Request $request
     * @return Program
     */
    public function createFromRequest(Request $request)
    {
        $this->httpCompletion($request);

        return $this->create([
            'user_id'               => $request->user()->id,
            'circle_id'             => $this->circle->id,
            'name'                  => $request->name,
            'from'                  => new Carbon($request->from),
            'to'                    => new Carbon($request->to),
            'summary'               => $request->summary,
            'description'           => $request->description,
            'location'              => $request->location,
            'website'               => $request->website,
            'facebook_event_id'     => $request->facebook_event_id,
            'display_poster'        => $request->get('display_poster', false),
            'display_email'         => $request->get('display_email', false)
        ], $request->hasFile('poster') ? $request->file('poster') : null);
    }

    /**
     * @param array $data
     * @param UploadedFile|null $poster
     * @return Program
     */
    public function create(array $data, UploadedFile $poster = null)
    {
        /**
         * @var $program Program
         */
        $program = Program::create($data);

        if( isset($poster) ) {
            $this->uploadPoster($program, $poster);
        }

        return $program;
    }

    public function updateFromRequest(Request $request)
    {
        $this->update([
            'name'                  => $request->name,
            'from'                  => new Carbon($request->from),
            'to'                    => new Carbon($request->to),
            'summary'               => $request->summary,
            'description'           => $request->description,
            'location'              => $request->location,
            'website'               => $request->website,
            'facebook_event_id'     => $request->facebook_event_id,
            'display_poster'        => $request->get('display_poster', false),
            'display_email'         => $request->get('display_email', false)
        ], $request->hasFile('poster') ? $request->file('poster') : null);
    }

    /**
     * @param array $data
     * @param UploadedFile $poster
     */
    public function update(array $data, UploadedFile $poster = null)
    {
        $this->program->update($data);

        if( isset($poster) ) {
            $this->uploadPoster($this->program, $poster);
        }
    }

    /**
     * @param Request $request
     */
    private function httpCompletion(Request $request)
    {
        if( $request->has('website') && !empty($request->website) &&
            (
                strpos($request->website, 'http://') !== 0 &&
                strpos($request->website, 'https://') !== 0
            ) ) {
            $request->merge(['website' => 'http://' . $request->website]);
        }
    }

    /**
     * @param Program $program
     * @param UploadedFile $poster
     */
    private function uploadPoster(Program $program, UploadedFile $poster)
    {
        $name = $program->id .
            '_' .
            sha1(str_random()) .
            '.' .
            $poster->extension();

        $path = $this->storage->putFileAs('posters', $poster, $name);

        if( $path ) {
            if( $program->hasPoster() )
                $program->poster->delete();

            Poster::create([
                'program_id'    => $program->id,
                'file'          => $name
            ]);
        }
    }
}