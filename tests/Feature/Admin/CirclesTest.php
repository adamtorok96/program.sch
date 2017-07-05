<?php

namespace Tests\Feature\Admin;


use App\Models\Circle;
use Tests\AdminFeatureTestCase;

class CirclesTest extends AdminFeatureTestCase
{
    /**
     * @var Circle $circle
     */
    private $circle;

    protected function setUp()
    {
        parent::setUp();

        $this->circle = factory(Circle::class)->create();
    }

    public function testIndex()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/circles')
            ->assertSeeText('Körök')
            ->assertStatus(200)
        ;
    }

    public function testShow()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/circles/' . $this->circle->id)
            ->assertSeeText('Körök')
            ->assertSeeText($this->circle->name)
            ->assertStatus(200)
        ;
    }
}