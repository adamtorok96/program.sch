<?php

namespace Tests;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;

abstract class UnitTestCase extends TestCase
{
    use DatabaseTransactions;
    use CreatesApplication;

    private static $isDbMigrated = false;

    protected function setUp()
    {
        parent::setUp();

        if( UnitTestCase::$isDbMigrated == false )
        {
            $this->artisan('migrate:refresh');
            $this->artisan('db:seed');

            UnitTestCase::$isDbMigrated = true;
        }
    }
}