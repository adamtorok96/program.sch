<?php

namespace Tests\Feature\Admin;


use App\Models\Resort;
use Tests\AdminFeatureTestCase;

class ResortsTest extends AdminFeatureTestCase
{
    /**
     * @var Resort $resort
     */
    private $resort;

    protected function setUp()
    {
        parent::setUp();

        $this->resort = factory(Resort::class)->create();
    }

    public function testIndex()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/resorts')
            ->assertSeeText('Reszortok')
            ->assertStatus(200)
        ;
    }

    public function testShow()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/resorts/' . $this->resort->id)
            ->assertSeeText('Reszortok')
            ->assertSeeText($this->resort->name)
            ->assertStatus(200)
        ;
    }
}