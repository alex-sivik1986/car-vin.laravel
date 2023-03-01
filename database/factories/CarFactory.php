<?php

namespace Database\Factories;

use App\Http\Services\VinDecoderServices as Vincode;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $vin_code = ['3VWDP7AJ7DM', 'JTEFU5JRXM', '1C4PJMCS8FW', 'JTJHY7AX6G', '1G1YA2D75F5','WAUGUGFF9H'];
        $key = array_rand($vin_code);
        $code = $vin_code[$key].$this->faker->numberBetween(222222,555555);

        $data_code = (new Vincode())->decode($code);

        return array_merge([
            'name' => $this->faker->firstName,
            'country_number' => $this->faker->countryCode.$this->faker->numberBetween(11111,55555),
            'color' => $this->faker->colorName,
            'vin_code' => $code
        ], $data_code);
    }
}
