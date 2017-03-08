<?php

namespace App\Services;


use Google_Client;
use Google_Service_Calendar;

class GoogleService
{
    private $client;
    private $calendar;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->useApplicationDefaultCredentials();
        $this->client->addScope([Google_Service_Calendar::CALENDAR]);

        $this->calendar = new Google_Service_Calendar($this->client);
    }

    public function events()
    {
        return $this->calendar->events->listEvents(env('GOOGLE_CALENDAR_ID'))->getItems();
    }
}