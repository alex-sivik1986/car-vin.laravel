<?php

namespace App\Exports;

use App\Http\Filters\CarFilter;
use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCar implements FromCollection, WithHeadings {

    public $car;

    public function __construct(CarFilter $car)
    {
        $this->car = $car;
    }

    public function headings():array {
        return [
            'id',
            'name',
            'country_number',
            'vin_code',
            'color',
            'make',
            'model',
            'year',
            'create',
            'update'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Car::filter($this->car)->get();
    }
}
