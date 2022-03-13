<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

Route::get('/books', [BookController::class, 'index']);
Route::get('/search', [BookController::class, 'search']);

# Make sure the create route comes before the `/books/{slug}` route so it takes precedence
Route::get('/books/create', [BookController::class, 'create']);

# Note the use of the post method in this route
Route::post('/books', [BookController::class, 'store']);

//Route::get('/books/{title}', [BookController::class, 'show']);
Route::get('/books/{slug}', [BookController::class, 'show']);
Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

Route::get('/book/{id}', function ($id) {
    return 'You have requested book #'.$id;
});

Route::get('/list', [ListController::class, 'show']);

// test
/*
Route::get('/example', function () {
    //dump,dd , dump, var_dump if needed
    return view('abc');
});
*/
 //end of test