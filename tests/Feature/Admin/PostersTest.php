<?php

namespace Tests\Feature\Admin;


use Tests\AdminFeatureTestCase;

class PostersTest extends AdminFeatureTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testIndex()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/posters')
            ->assertSeeText('Plakátok')
            ->assertStatus(200)
        ;
    }
}