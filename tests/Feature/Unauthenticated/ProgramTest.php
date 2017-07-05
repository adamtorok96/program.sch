<?php

namespace Tests\Feature\Unauthenticated;


use App\Models\Circle;
use App\Models\Program;
use Tests\FeatureTestCase;

class ProgramTest extends FeatureTestCase
{
    /**
     * @var Circle $circle
     */
    private $circle;

    /**
     * @var Program $program
     */
    private $program;

    protected function setUp()
    {
        parent::setUp();

        $this->circle = factory(Circle::class)->create();

        $this->program = factory(Program::class)->create([
            'circle_id' => $this->circle->id,
            'user_id'   => $this->user->id
        ]);
    }

    public function testIndex()
    {
        $this
            ->get('/programs')
            ->assertStatus(404)
        ;
    }

    public function testShow()
    {
        $this
            ->get('/programs/' . $this->program->id)
            ->assertSeeText('Programok')
            ->assertSeeText($this->program->name)
            ->assertSeeText($this->circle->name)
            ->assertSeeText($this->program->location)
            ->assertStatus(200)
        ;
    }

    public function testCreate()
    {
        $this
            ->get('/programs/create/' . $this->circle->id)
            ->assertRedirect('/')
        ;
    }

    public function testStore()
    {
        $this
            ->post('/programs/store/' . $this->circle->id)
            ->assertRedirect('/')
        ;
    }

    public function testEdit()
    {
        $this
            ->get('/programs/edit/' . $this->program->id)
            ->assertRedirect('/')
        ;
    }

    public function testUpdate()
    {
        $this
            ->post('/programs/update/' . $this->program->id)
            ->assertRedirect('/')
        ;
    }
}