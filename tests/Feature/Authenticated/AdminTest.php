<?php

namespace Tests\Feature\Authenticated;


use Tests\FeatureTestCase;

class AdminTest extends FeatureTestCase
{
    public function testIndex()
    {
        $this
            ->actingAs($this->user)
            ->get('/admin')
            ->assertStatus(403)
        ;
    }
}