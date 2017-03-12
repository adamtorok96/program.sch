<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this
            ->get('/')
            ->assertStatus(200)
        ;
    }

    public function testNextWeek()
    {
        $this
            ->get('/')
            ->assertSee('Következő hét')
        ;
    }

    public function testPrevWeek()
    {
        $this
            ->get('/')
            ->assertSee('Előző hét')
        ;
    }

    public function test404()
    {
        $this
            ->get('/' . str_random())
            ->assertStatus(404)
        ;
    }
}
