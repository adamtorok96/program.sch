<?php

namespace App\Console\Commands;

use FakeProgramSeeder;
use FakeUserSeeder;
use Illuminate\Console\Command;

class FakeSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:fake';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fake seeding';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $seeds = [
            new FakeUserSeeder(),
            new FakeProgramSeeder()
        ];

        foreach ($seeds as $seed) {
            $seed->run();
        }
    }
}
