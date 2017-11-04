<?php

namespace Tests\Feature\Authenticated;


use Tests\FeatureTestCase;

class CalendarTest extends FeatureTestCase
{
    public function testIndex()
    {
        $this
            ->actingAs($this->user)
            ->get('/')
            ->assertSeeText('Program.sch')
            ->assertStatus(200)
        ;
    }

    public function testNextWeek()
    {
        $this
            ->actingAs($this->user)
            ->get('/calendar/' . random_int(1, 10))
            ->assertStatus(200)
        ;
    }

    public function testPreviousWeek()
    {
        $this
            ->actingAs($this->user)
            ->get('/calendar/-' . random_int(1, 10))
            ->assertStatus(200)
        ;
    }
}