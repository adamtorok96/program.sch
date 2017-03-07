<?php

namespace App\Providers;

use Google_Client;
use Google_Service_Calendar;
use Illuminate\Support\ServiceProvider;

class GoogleCalendarProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Google_Client::class, function($app) {
            return $this->getGoogleClient();
        });
    }

    private function getGoogleClient()
    {
        $client = new Google_Client();
        $client->setDeveloperKey('AIzaSyCXAkJf6_7iK9mlCUduxDug8TBYAg52_yQ');
        //$client->setApplicationName('Program.sch Google Calendar Api');
       // $client->useApplicationDefaultCredentials();
        //$client->setScopes([Google_Service_Calendar::CALENDAR_READONLY]);
        //$client->setAuthConfig(base_path('google.json'));
        //$client->setAccessType('offline');
        /*$client->setScopes([Google_Service_Calendar::CALENDAR_READONLY]);
        //$client->set
        $client->setAuthConfig(base_path('google.json'));
        $client->setAccessType('offline');*/

        /*
        $credentialsPath = base_path('google-auth.json');
        if (file_exists($credentialsPath)) {
            $accessToken = json_decode(file_get_contents($credentialsPath), true);
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            echo ("Open the following link in your browser:\n%s\n" . $authUrl);
            print 'Enter verification code: ';
            $authCode = ''; //trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

            // Store the credentials to disk.
            if(!file_exists(dirname($credentialsPath))) {
                mkdir(dirname($credentialsPath), 0700, true);
            }
            file_put_contents($credentialsPath, json_encode($accessToken));
            printf("Credentials saved to %s\n", $credentialsPath);
        }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
        }
        */
        return $client;
    }
}
