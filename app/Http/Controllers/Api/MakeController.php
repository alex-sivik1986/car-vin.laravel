<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\MakeFilter;
use App\Http\Resources\MakeResource;
use App\Models\Make;
use App\Models\ModelCar;


class MakeController extends Controller
{
    public function autocomplete(MakeFilter $make)
    {
        return MakeResource::collection(Make::filter($make)->paginate(10));
    }

}
