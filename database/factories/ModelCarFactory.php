<?php

namespace Database\Factories;

use App\Models\Make;
use App\Models\ModelCar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class ModelCarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $makes = Make::all();

        foreach ($makes as $make)
        {
            $modelCar = Http::retry(2, 500)->get("https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeid/{$make->api_make_id}?format=json");

            if(isset($modelCar['Results']))
            {
                foreach ($modelCar['Results'] as $car)
                {
                    ModelCar::create([
                        'name' => $car['Model_Name'],
                        'model_id' => $car['Model_ID'],
                        'make_id' => $make->api_make_id,
                    ]);
                }
            }
        }

        return [];
    }
}
