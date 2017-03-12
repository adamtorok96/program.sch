<?php

namespace Tests\Feature;


use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testRedirection()
    {
        $this
            ->get('/auth/sch/redirect')
            ->assertStatus(302)
        ;
    }

    public function testCallbackRedirection()
    {
        $this
            ->get('/auth/sch/callback')
            ->assertStatus(302)
        ;
    }
}