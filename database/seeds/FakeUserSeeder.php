<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FakeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, random_int(10, 50))->create();
    }
}
