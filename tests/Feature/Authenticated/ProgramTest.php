<?php

namespace Tests\Feature\Authenticated;


use App\Models\Circle;
use App\Models\Program;
use Carbon\Carbon;
use Tests\FeatureTestCase;

class ProgramTest extends FeatureTestCase
{
    /**
     * @var Circle $circle
     */
    private $circle;

    /**
     * @var Program $program
     */
    private $program;

    protected function setUp()
    {
        parent::setUp();

        $this->circle = factory(Circle::class)->create();

        $this->program = factory(Program::class)->create([
            'circle_id' => $this->circle->id,
            'user_id'   => $this->user->id
        ]);
    }

    public function testInfo()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/info')
            ->assertSeeText('Információ')
            ->assertStatus(200)
        ;
    }

    public function testShow()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/' . $this->program->id)
            ->assertSeeText($this->program->name)
            ->assertSeeText($this->circle->name)
            ->assertSeeText($this->program->location)
            ->assertStatus(200)
        ;
    }

    public function testCreateWithoutCircle()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/create')
            ->assertStatus(404)
        ;
    }

    public function testCreateWithUnassignedCircle()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/create/' . $this->circle->id)
            ->assertStatus(403)
        ;
    }

    public function testCreateWithAssignedCircle()
    {
        $this->user->circles()->attach($this->circle);

        $this
            ->actingAs($this->user)
            ->get('/programs/create/' . $this->circle->id)
            ->assertStatus(403)
        ;

        $this->user->circles()->updateExistingPivot($this->circle->id, [
            'leader' => true
        ]);

        $this
            ->actingAs($this->user)
            ->get('/programs/create/' . $this->circle->id)
            ->assertStatus(200)
        ;
    }

    public function testStoreWithoutCircle()
    {
        $this
            ->actingAs($this->user)
            ->post('/programs/store')
            ->assertStatus(405)
        ;
    }

    public function testStoreWithUnassignedCircle()
    {
        $this
            ->actingAs($this->user)
            ->post('/programs/store/' . $this->circle->id)
            ->assertStatus(403)
        ;
    }

    public function testStoreWithAssignedCircle()
    {
        $this->user->circles()->attach($this->circle);

        $this
            ->actingAs($this->user)
            ->get('/programs/store/' . $this->circle->id)
            ->assertStatus(405)
        ;

        $this->user->circles()->updateExistingPivot($this->circle->id, [
            'leader' => true
        ]);

        $name               = str_random();
        $from               = Carbon::now()->addDays(random_int(1, 10));
        $to                 = $from->copy()->addHours(random_int(1, 8));
        $location           = str_random();
        $summary            = str_random();
        $description        = str_random();
        $website            = 'http://' . str_random() . '.hu';
        $facebook_event_id  = random_int(1000, 10000);
        $display_poster     = random_int(0, 1) === 1;
        $display_email      = random_int(0, 1) === 1;

        $this
            ->actingAs($this->user)
            ->post('/programs/store/' . $this->circle->id, [
                'name'              => $name,
                'from'              => $from,
                'to'                => $to,
                'location'          => $location,
                'summary'           => $summary,
                'description'       => $description,
                'website'           => $website,
                'facebook_event_id' => $facebook_event_id,
                'display_poster'    => $display_poster,
                'display_email'     => $display_email
            ])
            ->assertRedirect()
        ;

        $this
            ->assertDatabaseHas('programs', [
                'circle_id'         => $this->circle->id,
                'user_id'           => $this->user->id,
                'name'              => $name,
                'from'              => $from,
                'to'                => $to,
                'location'          => $location,
                'summary'           => $summary,
                'description'       => $description,
                'website'           => $website,
                'facebook_event_id' => $facebook_event_id,
                'display_poster'    => $display_poster,
                'display_email'     => $display_email
            ])
        ;
    }

    public function testEditWithoutProgram()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/edit')
            ->assertStatus(404)
        ;
    }

    public function testEditWithUnassignedCircle()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/edit/' . $this->program->id)
            ->assertStatus(403)
        ;
    }

    public function testEditWithAssignedCircle()
    {
        $this->user->circles()->attach($this->circle);

        $this
            ->actingAs($this->user)
            ->get('/programs/edit/' . $this->program->id)
            ->assertStatus(403)
        ;

        $this->user->circles()->updateExistingPivot($this->circle->id, [
            'leader' => true
        ]);

        $this
            ->actingAs($this->user)
            ->get('/programs/edit/' . $this->program->id)
            ->assertSeeText($this->program->name)
            ->assertStatus(200)
        ;
    }

    public function testUpdateWithoutProgram()
    {
        $this
            ->actingAs($this->user)
            ->post('/programs/update')
            ->assertStatus(405)
        ;
    }

    public function testUpdateWithUnassignedCircle()
    {
        $this
            ->actingAs($this->user)
            ->post('/programs/update/' . $this->program->id)
            ->assertStatus(403)
        ;
    }

    public function testUpdateWithAssignedCircle()
    {
        $this->user->circles()->attach($this->circle);

        $this
            ->actingAs($this->user)
            ->post('/programs/update/' . $this->program->id)
            ->assertStatus(403)
        ;

        $this->user->circles()->updateExistingPivot($this->circle->id, [
            'leader' => true
        ]);

        $name               = str_random();
        $from               = Carbon::now()->addDays(random_int(1, 10));
        $to                 = $from->copy()->addHours(random_int(1, 8));
        $location           = str_random();
        $summary            = str_random();
        $description        = str_random();
        $website            = 'http://' . str_random() . '.hu';
        $facebook_event_id  = random_int(1000, 10000);
        $display_poster     = random_int(0, 1) === 1;
        $display_email      = random_int(0, 1) === 1;

        $this
            ->actingAs($this->user)
            ->post('/programs/update/' . $this->program->id, [
                'name'              => $name,
                'from'              => $from,
                'to'                => $to,
                'location'          => $location,
                'summary'           => $summary,
                'description'       => $description,
                'website'           => $website,
                'facebook_event_id' => $facebook_event_id,
                'display_poster'    => $display_poster,
                'display_email'     => $display_email
            ])
            ->assertRedirect()
        ;

        $this
            ->assertDatabaseHas('programs', [
                'circle_id'         => $this->circle->id,
                'user_id'           => $this->user->id,
                'name'              => $name,
                'from'              => $from,
                'to'                => $to,
                'location'          => $location,
                'summary'           => $summary,
                'description'       => $description,
                'website'           => $website,
                'facebook_event_id' => $facebook_event_id,
                'display_poster'    => $display_poster,
                'display_email'     => $display_email
            ])
        ;
    }

    public function testDestroyWithoutProgram()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/destroy')
            ->assertStatus(404)
        ;
    }

    public function testDestroyWithUnassignedCircle()
    {
        $this
            ->actingAs($this->user)
            ->get('/programs/destroy/' . $this->program->id)
            ->assertStatus(403)
        ;
    }

    public function testDestroyWithAssignedCircle()
    {
        $this->user->circles()->attach($this->circle);

        $this
            ->actingAs($this->user)
            ->get('/programs/destroy/' . $this->program->id)
            ->assertStatus(403)
        ;

        $this
            ->assertDatabaseHas('programs', [
                'id' => $this->program->id
            ])
        ;

        $this->user->circles()->updateExistingPivot($this->circle->id, [
            'leader' => true
        ]);

        $this
            ->actingAs($this->user)
            ->get('/programs/destroy/' . $this->program->id)
            ->assertStatus(302)
        ;

        $this
            ->assertDatabaseMissing('programs', [
                'id' => $this->program->id
            ])
        ;
    }
}