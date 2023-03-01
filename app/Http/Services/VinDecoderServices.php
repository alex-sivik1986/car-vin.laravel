<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class VinDecoderServices
{
    private $baseUrl = 'https://vpic.nhtsa.dot.gov/api';

    public function decode($code)
    {
        $url = "{$this->baseUrl}/vehicles/DecodeVinValues/{$code}?format=json";
        $response = Http::get($url)->json();
        if(isset($response['Results']))
        {
            return [
                'make' => $response['Results'][0]['Make'],
                'year' => $response['Results'][0]['ModelYear'],
                'model' => $response['Results'][0]['Model'],
            ];
        } else {
            return ['make' => '','year' => '','model' => '',];
        }


    }
}
