<?php


namespace App\Managers;


use App\Models\Circle;
use App\Models\Poster;
use App\Models\Program;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgramsManager
{
    /**
     * @var $program Program
     */
    protected $program;

    /**
     * @var $circle Circle
     */
    protected $circle;

    /**
     * @var $user User
     */
    protected $user;


    /**
     * @param Program $program
     * @return ProgramsManager
     */
    public function setProgram(Program $program)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * @param Circle $circle
     * @return ProgramsManager
     */
    public function setCircle(Circle $circle)
    {
        $this->circle = $circle;

        return $this;
    }

    /**
     * @param User $user
     * @return ProgramsManager
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param Request $request
     * @return Program|\Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        $this->httpCompletion($request);

        $program = Program::create([
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
        ]);

        if( $request->hasFile('poster') ) {
            $this->uploadPoster($program, $request,'poster');
        }

        return $program;
    }

    public function update(Request $request)
    {
        $this->httpCompletion($request);

        $this->program->update([
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
        ]);

        if( $request->hasFile('poster') ) {
            $this->uploadPoster($this->program, $request,'poster');
        }
    }

    /**
     * @param Program $program
     * @param Request $request
     * @param $file
     */
    private function uploadPoster(Program $program, Request $request, $file)
    {
        $name = $program->id .
            '_' .
            sha1(str_random()) .
            '.' .
            $request->file($file)->extension();

        if( $request->file($file)->storeAs(
            'posters',
            $name,
            'public'
        )) {
            if( $program->hasPoster() )
                $program->poster->delete();

            Poster::create([
                'program_id'    => $program->id,
                'file'          => $name
            ]);
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
}