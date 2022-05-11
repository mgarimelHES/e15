<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Parking;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('/parkings', function (Request $request) {
        return Parking::all();
    });
    
    Route::get('/parkings/{slug}', function (Request $request, $slug) {
        return Parking::findBySlug($slug);
    });
});