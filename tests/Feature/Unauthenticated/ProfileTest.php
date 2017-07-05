<?php

namespace Tests\Feature\Unauthenticated;


use Tests\FeatureTestCase;

class ProfileTest extends FeatureTestCase
{
    public function testIndex()
    {
        $this
            ->get('/profile')
            ->assertRedirect('/')
        ;
    }
}