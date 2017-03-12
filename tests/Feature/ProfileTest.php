<?php

namespace Tests\Feature;


use Tests\TestCase;

class ProfileTest extends TestCase
{

    public function testUnAuthenticatedTest()
    {
        $this->get('/profile')->assertStatus(302);
    }
}