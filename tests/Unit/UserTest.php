<?php

namespace Tests\Unit;


use App\Models\Calendar;
use App\Models\Circle;
use App\Models\Role;
use App\Models\SocialAccount;
use App\Models\User;
use Tests\UnitTestCase;

class UserTest extends UnitTestCase
{
    /**
     * @var User $user
     */
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testRelations()
    {
        # SocialAccounts
        self::assertEquals(0, $this->user->accounts()->count());

        factory(SocialAccount::class)->create([
            'user_id' => $this->user->id
        ]);

        self::assertEquals(1, $this->user->accounts()->count());

        # Circles
        self::assertEquals(0, $this->user->circles()->count());

        $circle = factory(Circle::class)->create();

        $this->user->circles()->attach($circle);
        $this->user = $this->user->find($this->user->id);

        self::assertEquals(1, $this->user->circles()->count());

        # Filters
        self::assertEquals(0, $this->user->filters()->count());

        $filteredCircle = factory(Circle::class)->create();

        $this->user->filters()->attach($filteredCircle);
        $this->user = $this->user->find($this->user->id);

        self::assertEquals(1, $this->user->filters()->count());

        # Calendar
        self::assertFalse($this->user->calendar()->exists());

        $calendar = factory(Calendar::class)->create([
            'user_id' => $this->user->id
        ]);

        self::assertTrue($this->user->calendar()->exists());
    }

    public function testIsAdmin()
    {
        self::assertFalse($this->user->isAdmin());

        $this->user->attachRole(Role::whereName('admin')->firstOrFail());
        $this->user = $this->user->find($this->user->id);

        self::assertTrue($this->user->isAdmin());
    }

    public function testIsPrManagerAt()
    {
        $circle = factory(Circle::class)->create();

        $this->user->circles()->attach($circle);
        $this->user = $this->user->find($this->user->id);

        self::assertFalse($this->user->isPrManagerAt($circle));

        $this->user->circles()->updateExistingPivot($circle->id, [
            'site_pr' => true
        ]);
        $this->user = $this->user->find($this->user->id);

        $this
            ->assertDatabaseHas('circle_user', [
                'circle_id' => $circle->id,
                'user_id'   => $this->user->id,
                'leader'    => false,
                'pr'        => false,
                'site_pr'   => true
            ])
        ;

        self::assertTrue($this->user->isPrManagerAt($circle));

        $this->user->circles()->updateExistingPivot($circle->id, [
            'site_pr'   => null,
            'leader'    => true
        ]);
        $this->user = $this->user->find($this->user->id);

        $this
            ->assertDatabaseHas('circle_user', [
                'circle_id' => $circle->id,
                'user_id'   => $this->user->id,
                'leader'    => true,
                'pr'        => false,
                'site_pr'   => null
            ])
        ;

        self::assertTrue($this->user->isPrManagerAt($circle));

        $this->user->circles()->updateExistingPivot($circle->id, [
            'leader'    => false,
            'pr'        => true
        ]);
        $this->user = $this->user->find($this->user->id);

        $this
            ->assertDatabaseHas('circle_user', [
                'circle_id' => $circle->id,
                'user_id'   => $this->user->id,
                'leader'    => false,
                'pr'        => true,
                'site_pr'   => null
            ])
        ;

        self::assertTrue($this->user->isPrManagerAt($circle));

        $this->user->circles()->updateExistingPivot($circle->id, [
            'pr'        => true,
            'site_pr'   => false
        ]);
        $this->user = $this->user->find($this->user->id);

        $this
            ->assertDatabaseHas('circle_user', [
                'circle_id' => $circle->id,
                'user_id'   => $this->user->id,
                'leader'    => false,
                'pr'        => true,
                'site_pr'   => false
            ])
        ;

        self::assertFalse($this->user->isPrManagerAt($circle));
    }
}