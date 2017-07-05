<?php

namespace Tests;


use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;

abstract class AdminFeatureTestCase extends TestCase
{
    use DatabaseTransactions;
    use CreatesApplication;

    private static $isDbMigrated = false;

    /**
     * @var User $admin
     */
    protected $admin;

    protected function setUp()
    {
        parent::setUp();

        if( AdminFeatureTestCase::$isDbMigrated == false ) {
            $this->artisan('migrate:refresh');
            $this->artisan('db:seed');

            AdminFeatureTestCase::$isDbMigrated = true;
        }

        $this->admin = factory(User::class)->create();

        $this->admin->attachRole(Role::whereName('admin')->firstOrFail());
    }
}