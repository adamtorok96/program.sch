<?php

namespace Tests\Unit;


use App\Models\Circle;
use App\Models\Resort;
use Tests\UnitTestCase;

class CircleTest extends UnitTestCase
{
    /**
     * @var Circle $circle
     */
    private $circle;

    protected function setUp()
    {
        parent::setUp();

        $this->circle = factory(Circle::class)->create();
    }

    public function testRelations()
    {
        self::assertFalse($this->circle->resort()->exists());

        $resort = factory(Resort::class)->create();

        $this->circle->update([
            'resort_id' => $resort->id
        ]);

        $this->circle = $this->circle->find($this->circle->id);

        self::assertTrue($this->circle->resort()->exists());
        self::assertEquals($resort->id, $this->circle->resort->id);
    }
}