<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class SchProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = [
        'basic',
        'displayName',
        'mail',
        'eduPersonEntitlement',
    ];

    protected $scopeSeparator = ' ';

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://auth.sch.bme.hu/site/login', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://auth.sch.bme.hu/oauth2/token';
    }

    protected function getTokenFields($code)
    {
        return array_add(parent::getTokenFields($code), 'grant_type', 'authorization_code');
    }

    protected function getUserByToken($token)
    {
        $response = $this
            ->getHttpClient()
            ->get('https://auth.sch.bme.hu/api/profile?access_token=' . $token);

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        $result             = new User();

        $result->id         = $user['internal_id'];
        $result->name       = $user['displayName'];
        $result->email      = $user['mail'];
        $result->circles    = isset($user['eduPersonEntitlement']) ? $user['eduPersonEntitlement'] : [];

        return $result;
    }
}