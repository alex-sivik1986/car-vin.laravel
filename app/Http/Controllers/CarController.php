<?php

namespace App\Http\Controllers;

use App\Exports\ExportCar;
use App\Http\Filters\CarFilter;
use App\Http\Requests\CarFormRequest;
use App\Models\Car;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarFilter $data)
    {
        return view('car.index', ['cars' => Car::filter($data)->paginate(10), 'hrefImport' => $_REQUEST]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
    }

    public function store(CarFormRequest $request)
    {
        $car = Car::create([
            'name' => $request->input('name'),
            'country_number' => $request->input('country_number'),
            'color' => $request->input('color'),
            'vin_code' => $request->input('vin_code'),
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
        ]);

        return redirect('cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('car.update', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarFormRequest $request, Car $car)
    {
        $car->update([
            'name' => $request->input('name', $car->name),
            'country_number' => $request->input('country_number', $car->country_number),
            'color' => $request->input('color', $car->color),
            'model' => $request->input('model', $car->model),
            'make' => $request->input('make', $car->make),
            'year' => $request->input('year', $car->year),
            'vin_code' => $request->input('vin_code', $car->vin_code),
        ]);

        return redirect('cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect('cars');
    }

    public function exportXls(CarFilter $car)
    {
        return Excel::download(new ExportCar($car), 'cars.xls', \Maatwebsite\Excel\Excel::XLS);
    }
}
