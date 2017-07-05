<?php

namespace Tests\Unit;


use App\Models\Circle;
use App\Models\Program;
use App\Models\User;
use Carbon\Carbon;
use Tests\UnitTestCase;

class ProgramTest extends UnitTestCase
{
    /**
     * @var User $user
     */
    private $user;

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

        $this->user = factory(User::class)->create();

        $this->circle = factory(Circle::class)->create();

        $this->program = factory(Program::class)->create([
            'user_id'   => $this->user->id,
            'circle_id' => $this->circle->id
        ]);
    }

    public function testRelations()
    {
        self::assertEquals($this->user->id, $this->program->user->id);
        self::assertEquals($this->circle->id, $this->program->circle->id);

        self::assertFalse($this->program->poster()->exists());
        self::assertFalse($this->program->hasPoster());
    }

    public function testScopeOnThisDay()
    {
        $from   = Carbon::now()->subDays(3);
        $to     = $from->copy()->addDay();

        $this->program->update([
            'from'      => $from,
            'to'        => $to
        ]);

        $this
            ->assertDatabaseHas('programs', [
                'id'    => $this->program->id,
                'from'  => $from,
                'to'    => $to
            ])
        ;

        self::assertEquals(1, Program::OnThisDay($from)->count());
        self::assertEquals(1, Program::OnThisDay($to)->count());

        $before = $from->copy()->subDay();

        self::assertEquals(0, Program::OnThisDay($before)->count());

        $during = $from->copy()->addHours(12);

        self::assertEquals(1, Program::OnThisDay($during)->count());

        $after = $to->copy()->addDay();

        self::assertEquals(0, Program::OnThisDay($after)->count());
    }

    public function testScopeStartOnThisDay()
    {
        $from = Carbon::now()->subDays(3)->hour(12);

        $this->program->update([
            'from' => $from
        ]);

        self::assertEquals(1, Program::StartOnThisDay($from)->count());

        $before = $from->copy()->subDay();

        self::assertEquals(0, Program::StartOnThisDay($before)->count());

        $onThisDay = $from->copy()->addHour();

        self::assertEquals(1, Program::StartOnThisDay($onThisDay)->count());

        $after = $from->copy()->addDay();

        self::assertEquals(0, Program::StartOnThisDay($after)->count());
    }

    public function testScopeFiltered()
    {
        $user = factory(User::class)->create();

        self::assertEquals(0, Program::Filtered($user)->count());
        self::assertEquals(0, Program::Filtered($this->user)->count());

        $user->filters()->attach($this->circle);

        self::assertEquals(1, Program::Filtered($user)->count());
        self::assertEquals(0, Program::Filtered($this->user)->count());
    }

    public function testScopeInterTemporal()
    {
        $from   = Carbon::now()->subDays(3);
        $to     = $from->copy();

        $this->program->update([
            'from'  => $from,
            'to'    => $to
        ]);

        self::assertEquals(0, Program::InterTemporal()->count());

        $to->addDay();

        $this->program->update([
            'to' => $to
        ]);

        self::assertEquals(1, Program::InterTemporal()->count());
    }

    public function testScopeOneTime()
    {
        $from   = Carbon::now()->subDays(3);
        $to     = $from->copy();

        $this->program->update([
            'from'  => $from,
            'to'    => $to
        ]);

        self::assertEquals(1, Program::OneTime()->count());

        $to->addDay();

        $this->program->update([
            'to' => $to
        ]);

        self::assertEquals(0, Program::OneTime()->count());
    }
}