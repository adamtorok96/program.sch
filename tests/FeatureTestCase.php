<?php

namespace Tests;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;

abstract class FeatureTestCase extends TestCase
{
    use DatabaseTransactions;
    use CreatesApplication;

    private static $isDbMigrated = false;

    /**
     * @var User $user
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();

        if( !FeatureTestCase::$isDbMigrated ) {
            $this->artisan('migrate:refresh');
            $this->artisan('db:seed');

            FeatureTestCase::$isDbMigrated = true;
        }

        $this->user = factory(User::class)->create();
    }
}