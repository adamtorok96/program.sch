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

    public function testFiltersEnable()
    {
        $this
            ->actingAs($this->user)
            ->get('/profile/filters/enable')
            ->assertRedirect('/profile')
        ;

        $this
            ->assertDatabaseHas('users', [
                'id'        => $this->user->id,
                'filter'    => true
            ])
        ;
    }

    public function testFiltersDisable()
    {
        $this->user->update([
            'filter' => true
        ]);

        $this
            ->actingAs($this->user)
            ->get('/profile/filters/disable')
            ->assertRedirect('/profile')
        ;

        $this
            ->assertDatabaseHas('users', [
                'id'        => $this->user->id,
                'filter'    => false
            ])
        ;
    }
}