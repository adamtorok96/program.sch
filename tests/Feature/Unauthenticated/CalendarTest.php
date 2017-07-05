<?php

namespace Tests\Feature\Unauthenticated;


use Tests\FeatureTestCase;

class CalendarTest extends FeatureTestCase
{
    public function testIndex()
    {
        $this
            ->get('/')
            ->assertSeeText('Program.sch')
            ->assertStatus(200)
        ;
    }
}