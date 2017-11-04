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

    public function testNextWeek()
    {
        $this
            ->get('/calendar/' . random_int(1, 10))
            ->assertStatus(200)
        ;
    }

    public function testPreviousWeek()
    {
        $this
            ->get('/calendar/-' . random_int(1, 10))
            ->assertStatus(200)
        ;
    }
}