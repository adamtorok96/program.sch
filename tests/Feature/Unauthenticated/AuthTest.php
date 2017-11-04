<?php

namespace Tests\Feature\Unauthenticated;


use Tests\FeatureTestCase;

class AuthTest extends FeatureTestCase
{
    public function testIndex()
    {
        $this
            ->get('/auth')
            ->assertStatus(404)
        ;
    }

    public function testRedirectSch()
    {
        $this
            ->get('/auth/sch/redirect')
            ->assertRedirect()
        ;
    }

    public function testRedirectUnknown()
    {
        $this
            ->get('/auth/' . str_random() . '/redirect')
            ->assertStatus(404)
        ;
    }

    public function testCallbackSch()
    {
        $this
            ->get('/auth/sch/callback')
            ->assertStatus(302)
        ;
    }

    public function testCallbackUnknown()
    {
        $this
            ->get('/auth/' . str_random() . '/callback')
            ->assertStatus(404)
        ;
    }

    public function testLogout()
    {
        $this
            ->get('/auth/logout')
            ->assertStatus(302)
        ;
    }
}