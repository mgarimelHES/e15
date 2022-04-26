<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PracticeController;

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

Route::get('/example', function () {
    return 'Example';
});

/**
 * Bookmark - Misc
 */

Route::any('/practice/{n?}', [PracticeController::class, 'index']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/', [PageController::class, 'welcome']);


Route::group(['middleware' => 'auth'], function () {
    // Restrict authorized users only
    /**
     * Book - Create
     */

    # Make sure the create route comes before the `/books/{slug}` route so it takes precedence
    Route::get('/books/create', [BookController::class, 'create']);

    # Note the use of the post method in this route
    Route::post('/books', [BookController::class, 'store']);

    /**
     * Book - READ
     */

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/search', [BookController::class, 'search']);


    //Route::get('/books/{title}', [BookController::class, 'show']);
    Route::get('/books/{slug}', [BookController::class, 'show']);
    Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);
    //Route::get('/list', [ListController::class, 'show']);
    Route::get('/list', [BookController::class, 'list']);

    /**
     * Book - Update
     */
    //Show the form to edit a specific book
    Route::get('/books/{slug}/edit', [BookController::class,'edit']);
    //Process the form to edit a specific book
    Route::put('/books/{slug}', [BookController::class, 'update']);

    /**
     * Book - Delete
     */

    //Show the form to confirm a specific book deletion
    Route::get('/books/{slug}/delete', [BookController::class,'delete']);

    //Process the form to delete a specific book
    Route::delete('/books/{slug}/', [BookController::class,'destroy']);
    /**
     * Book - List
     */
    Route::get('/list', [ListController::class, 'show']);
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::post('/list/{slug?}/save', [ListController::class, 'save']);
});
// Route group  end to restrict allowed users


// test
/*
Route::get('/example', function () {
    //dump,dd , dump, var_dump if needed
    return view('abc');
});

Route::get('/book/{id}', function ($id) {
    return 'You have requested book #'.$id;
});

*/
 //end of test