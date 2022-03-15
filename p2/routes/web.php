<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;

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

# Make sure the create route comes before the `/parkings/{slug}` route so it takes precedence
Route::get('/parkings/create', [ParkController::class, 'create']);
# Note the use of the post method in this route
Route::post('/parkings', [ParkController::class, 'store']);


Route::get('/parkings', [ParkController::class, 'index']);
Route::get('/process', [ParkController::class, 'process']);
Route::get('/search', [ParkController::class, 'search']);


//Route::get('/parkings/{vehicle}', [ParkController::class, 'show']);
Route::get('/parkings/{slug}', [ParkController::class, 'show']);
Route::get('/parkings/filter/{category}/{subcategory}', [ParkController::class, 'filter']);

Route::get('/parking/{id}', function ($id) {
    return 'Your parking information vehicle #'.$id;
});


Route::get('/parking/{vehicle}', [ParkController::class, 'show']);

Route::get('/list', [ListController::class, 'show']);

/*
Route::get('/', function () {
    return view('welcome');
});
*/