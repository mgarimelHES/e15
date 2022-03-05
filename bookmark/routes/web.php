<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{title}', [BookController::class, 'show']);
Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

Route::get('/book/{id}', function ($id) {
    return 'You have requested book #'.$id;
});

// test
/*
Route::get('/example', function () {
    //dump,dd , dump, var_dump if needed
    return view('abc');
});
*/
 //end of test