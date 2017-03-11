<?php

use App\Models\Resort;
use Illuminate\Database\Seeder;

class ResortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resorts = [
            'Kollégiumi Felvételi és Érdekvédelmi Reszort',
            'Szolgáltató Reszort',
            'Bulis Reszort',
            'Szent Schönherz Senior Lovagrend',
            'Simonyi Károly Szakkolégium',
            'Sport Reszort',
            'Kultúr Reszort',
            'Kollégiumi Számítástechnikai Kör'
        ];

        foreach ($resorts as $resort) {
            Resort::create([
               'name' => $resort
            ]);
        }
    }
}
