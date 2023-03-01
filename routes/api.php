<?php

use App\Exports\ExportCar;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'auto' => \App\Http\Controllers\Api\AutoController::class,
]);

Route::get('/auto/export', function (\App\Http\Filters\CarFilter $car) {
    return Excel::download(new ExportCar($car), 'cars.xlsx', \Maatwebsite\Excel\Excel::XLSX);
})->name('auto.export');
