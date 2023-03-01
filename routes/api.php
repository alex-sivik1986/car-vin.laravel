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

Route::apiResources([
    'auto' => \App\Http\Controllers\Api\AutoController::class,
]);

Route::get('/autocomplete', [\App\Http\Controllers\Api\MakeController::class, 'autocomplete'])->name('auto.autocomplete');
