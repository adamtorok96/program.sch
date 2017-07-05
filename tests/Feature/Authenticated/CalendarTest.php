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
}