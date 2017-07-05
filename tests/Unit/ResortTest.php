<?php

namespace Tests\Unit;


use App\Models\Circle;
use App\Models\Resort;
use Tests\UnitTestCase;

class ResortTest extends UnitTestCase
{
    /**
     * @var Resort $resort
     */
    private $resort;

    protected function setUp()
    {
        parent::setUp();

        $this->resort = factory(Resort::class)->create();
    }

    public function testRelations()
    {
        self::assertEquals(0, $this->resort->circles()->count());

        $circle = factory(Circle::class)->create([
            'resort_id' => $this->resort->id
        ]);

        self::assertEquals(1, $this->resort->circles()->count());
    }
}