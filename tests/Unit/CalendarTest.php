<?php

namespace Tests\Unit;


use App\Models\Calendar;
use App\Models\User;
use Tests\UnitTestCase;

class CalendarTest extends UnitTestCase
{

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var Calendar $calendar
     */
    private $calendar;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->calendar = factory(Calendar::class)->create([
            'user_id' => $this->user->id
        ]);
    }

    public function testRelations()
    {
        self::assertTrue($this->calendar->user()->exists());
        self::assertEquals($this->user->id, $this->calendar->user->id);
    }
}