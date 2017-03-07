<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          => 'admin',
            'display_name'  => 'Adminisztrátor',
            'description'   => 'Az oldal adminisztrátora'
        ]);
    }
}
