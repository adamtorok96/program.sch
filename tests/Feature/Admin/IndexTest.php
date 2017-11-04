<?php

namespace Tests\Feature\Admin;


use Tests\AdminFeatureTestCase;

class IndexTest extends AdminFeatureTestCase
{
    public function testIndex()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin')
            ->assertSeeText('Adminisztráció')
            ->assertStatus(200)
        ;
    }
}