<?php

namespace App\Http\Controllers\Api;

use App\Exports\ExportCar;
use App\Http\Controllers\Controller;
use App\Http\Filters\CarFilter;
use App\Http\Filters\MakeFilter;
use App\Http\Requests\CarFormRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Make;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarFilter $car, Request $request)
    {
        if (array_key_exists('export', $request->request->all()) && array_search('xls', $request->request->all()))
        {
            return Excel::download(new ExportCar($car), 'cars.xls', \Maatwebsite\Excel\Excel::XLS);
        }

       return CarResource::collection(Car::filter($car)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarFormRequest $request)
    {
       $new_car = Car::create($request->validated());

       return new CarResource($new_car);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CarResource(Car::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarFormRequest $request, $id)
    {

        $car = Car::findOrFail($id);
        $car->update($request->validated());

        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        if($car){
            return ['result'=>'Record has been deleted'];
        }
    }

    public function autocomplete(Make $make)
    {
        dd(1111111111111);
        return Make::filter($make)->paginate(10);
    }

}
