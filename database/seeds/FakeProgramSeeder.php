<?php

use App\Models\Program;
use Illuminate\Database\Seeder;

class FakeProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Program::class, random_int(100, 200))->create();
    }
}
