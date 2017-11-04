<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use Tests\AdminFeatureTestCase;

class UsersTest extends AdminFeatureTestCase
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

    public function testIndex()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/users')
            ->assertSeeText('Felhasználók')
            ->assertStatus(200)
        ;
    }

    public function testShow()
    {
        $this
            ->actingAs($this->admin)
            ->get('/admin/users/' . $this->user->id)
            ->assertSeeText('Felhasználók')
            ->assertSeeText($this->user->name)
            ->assertSeeText($this->user->email)
            ->assertStatus(200)
        ;
    }
}