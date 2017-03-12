<?php

namespace App\Http\Controllers;


use App\Models\Calendar;
use Auth;
use Carbon\Carbon;
use Webpatser\Uuid\Uuid;

class CalendarController extends Controller
{
    public function index($week = 0)
    {
        if( $week < -1000 || $week > 1000 )
            $week = 0;

        $days = [];

        $first  = Carbon::now()->startOfWeek()->addWeek($week);
        $last   = (new Carbon($first))->addDays(7 * 2);

        for($day = new Carbon($first); $day->lt($last); $day->addDay()) {
            $days[] = new Carbon($day);
        }

        return view('calendar.index', [
            'days'  => $days,
            'from'  => $first,
            'to'    => $last,
            'next'  => $week + 1,
            'prev'  => $week - 1
        ]);
    }

    public function calendar($uuid)
    {
        $calendar = Calendar::whereUuid($uuid)->firstOrFail();

        return response()->view('calendar.ical.calendar', [
            'calendar' => $calendar
        ], 200, [
            'Content-type' => 'text/calendar'
        ]);
    }

    public function create()
    {
        if( Auth::user()->hasCalendar() )
            abort(404);

        Calendar::create([
            'user_id'   => Auth::user()->id,
            'uuid'      => Uuid::generate()
        ]);

        return redirect()->route('profile.index');
    }
}