<?php

namespace App\Http\Controllers;


use App\Models\Program;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        $days = [];

        $first  = Carbon::now()->startOfWeek();
        $last   = (new Carbon($first))->addDays(7 * 2);

        for($day = $first; $day->lt($last); $day->addDay()) {
            $days[] = new Carbon($day);
        }

        return view('calendar.index', [
            'days' => $days
        ]);
    }
}