<?php


namespace Tests;


class AuthenticatedFeatureTestCase extends FeatureTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->actingAs($this->user);
    }
}