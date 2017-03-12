<?php

namespace tests\Feature;


use Tests\TestCase;

class AdminTest extends TestCase
{
    public function testUnAuthenticatedTest()
    {
        $this->get('/admin')->assertStatus(302);
    }
}