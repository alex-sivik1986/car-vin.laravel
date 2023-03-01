<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Make;
use App\Models\ModelCar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Car::factory(20)->create();
        Make::factory()->make();
        ModelCar::factory()->make();
    }
}
