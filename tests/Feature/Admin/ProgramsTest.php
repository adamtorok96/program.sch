<?php

namespace Tests\Feature\Admin;


use App\Models\Circle;
use App\Models\Program;
use App\Models\User;
use Tests\AdminFeatureTestCase;

class ProgramsTest extends AdminFeatureTestCase
{
    /**
     * @var Circle $circle
     */
    private $circle;

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var Program $program
     */
    private $program;

    protected function setUp()
    {
        parent::setUp();

        $this->circle = factory(Circle::class)->create();

        $this->user = factory(User::class)->create();

        $this->program = factory(Program::class)->create([
            'circle_id' => $this->circle->id,
            'user_id'   => $this->user->id
        ]);
    }

    public function testIndex()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/programs')
            ->assertSeeText('Programok')
            ->assertStatus(200)
        ;
    }

    public function testShow()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/programs/' . $this->program->id)
            ->assertSeeText('Programok')
            ->assertSeeText($this->program->name)
            ->assertSeeText($this->circle->name)
            ->assertSeeText($this->user->name)
            ->assertStatus(200)
        ;
    }
}