<?php

namespace Tests\Feature\Unauthenticated;


use Tests\FeatureTestCase;

class AdminTest extends FeatureTestCase
{
    public function testIndex()
    {
        $this
            ->get('/admin')
            ->assertRedirect('/')
        ;
    }
}