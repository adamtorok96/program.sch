<?php

namespace Tests\Feature\Authenticated;


use Tests\FeatureTestCase;

class ProfileTest extends FeatureTestCase
{
    public function testIndex()
    {
        $this
            ->actingAs($this->user)
            ->get('/profile')
            ->assertSeeText('Profil')
            ->assertSeeText($this->user->name)
            ->assertSeeText($this->user->email)
            ->assertStatus(200)
        ;
    }
}