<?php

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'ENT',
            'FNT',
            'Körfolyó',
            'Nagykonyha',
            '102',
            '103'
        ];

        foreach ($locations as $location) {
            Location::create([
               'name' => $location
            ]);
        }
    }
}
