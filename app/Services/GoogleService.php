<?php

namespace App\Services;


use App\Models\Program;
use Google_Client;
use Google_Exception;
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
        try {
            return $this->calendar->events->insert($this->getCalendarId(), new Google_Service_Calendar_Event([
                //'id'            => $program->uuid,
                'summary'       => $program->circle->name . ' -  '. $program->name,
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
        } catch (Google_Exception $exception) {
            return null;
        }
    }

    public function updateEvent(Program $program)
    {
        try {
            return $this->calendar->events->update($this->getCalendarId(), $program->google_calendar_event_id, new Google_Service_Calendar_Event([
                'summary'       => $program->circle->name . ' -  '. $program->name,
                'location'      => $program->location,
                'description'   => $program->summary,
                'sequence'      => $program->sequence,
                'start' => [
                    'dateTime' => $program->from->format('Y-m-d\TH:i:s'),
                    'timeZone' => config('app.timezone'),
                ],
                'end' => [
                    'dateTime' => $program->to->format('Y-m-d\TH:i:s'),
                    'timeZone' => config('app.timezone'),
                ],
            ]));
        } catch (Google_Exception $exception) {
            return null;
        }
    }

    public function deleteEvent(Program $program)
    {
        return isset($program->google_calendar_event_id) ? $this->calendar->events->delete($this->getCalendarId(), $program->google_calendar_event_id) : false;
    }

    private function getCalendarId()
    {
        return config('services.google.calendar_id');
    }
}