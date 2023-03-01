<?php

namespace Database\Factories;

use App\Models\Make;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class MakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $all = Http::retry(2,
            500)->get("https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json");

        if (isset($all['Results']))
        {
            $makes = array_slice($all['Results'], 0, 10);

            foreach ($makes as $model)
            {
                Make::create([
                    'api_make_id' => $model['Make_ID'],
                    'name' => $model['Make_Name'],
                ]);
            }
        }
        return [];
    }
}
