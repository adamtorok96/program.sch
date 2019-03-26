<?php


namespace App\Services;


use App\Models\Program;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CalendarDayService
{
    /**
     * @var Carbon
     */
    protected $day;

    /**
     * @var Builder
     */
    protected $query;

    /**
     * @param Carbon $day
     */
    public function setDay(Carbon $day) : void
    {
        $this->day   = $day;
        $this->query = Program::startOnThisDay($day)->orderBy('from');

        if( Auth::check() && Auth::user()->filter ) {
            $this->query->filtered(Auth::user());
        }
    }

    /**
     * @return bool
     */
    public function hasProgram() : bool
    {
        return $this->query->exists();
    }

    /**
     * @return Collection
     */
    public function getPrograms() : Collection
    {
        return $this->query->get();
    }
}