<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);

Route::get('/parkings', [ParkController::class, 'index']);

Route::get('/parkings/{vehicle}', [ParkController::class, 'show']);
Route::get('/parkings/filter/{category}/{subcategory}', [ParkController::class, 'filter']);

Route::get('/parking/{id}', function ($id) {
    return 'Your parking information vehicle #'.$id;
});

/*
Route::get('/', function () {
    return view('welcome');
});
*/