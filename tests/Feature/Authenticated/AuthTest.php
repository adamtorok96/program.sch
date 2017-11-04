<?php

namespace Tests\Feature\Authenticated;


use Tests\FeatureTestCase;

class AuthTest extends FeatureTestCase
{
    public function testLogout()
    {
        $this
            ->actingAs($this->user)
            ->get('/auth/logout')
            ->assertRedirect('/')
        ;
    }
}