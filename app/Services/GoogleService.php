<?php

namespace App\Services;


use App\Models\Program;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleService
{
    private $client;
    private $calendar;

    public function __construct()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google.json'));

        $this->client = new Google_Client();
        $this->client->useApplicationDefaultCredentials();
        $this->client->addScope([Google_Service_Calendar::CALENDAR]);

        $this->calendar = new Google_Service_Calendar($this->client);
    }

    public function events()
    {
        return $this->calendar->events->listEvents($this->getCalendarId())->getItems();
    }

    public function newEvent(Program $program)
    {
        $this->calendar->events->insert($this->getCalendarId(), new Google_Service_Calendar_Event([
            'id'            => $program->uuid,
            'summary'       => $program->name,
            'location'      => $program->location,
            'description'   => $program->summary,
            'sequence'      => $program->sequence,
            'status'        => 'confirmed',
            'transparency'  => 'transparent',
            'start' => [
                'dateTime' => $program->from->format('Y-m-d\TH:i:s'),
                'timeZone' => config('app.timezone'),
            ],
            'end' => [
                'dateTime' => $program->to->format('Y-m-d\TH:i:s'),
                'timeZone' => config('app.timezone'),
            ],
        ]));
    }

    public function deleteEvent(Program $program)
    {
        $this->calendar->events->delete($this->getCalendarId(), $program->uuid);
    }

    private function getCalendarId()
    {
        return env('GOOGLE_CALENDAR_ID');
    }
}