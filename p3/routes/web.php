<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\TestController;

use Illuminate\Support\Facades\App;

# Only enable the following development-specific routes if we’re *not* running the application in the `production` environment
if (!App::environment('production')) {
    Route::get('/test/login-as/{userId}', [TestController::class, 'loginAs']);
    Route::get('/test/refresh-database', [TestController::class, 'refreshDatabase']);

    # It’s a good idea to move the practice route into this if condition
    # so that our practice routes are not available on production
    Route::any('/practice/{n?}', [PracticeController::class, 'index']);
}

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
# Pratice related HERE
/**
 * Parking App - Misc
 */

Route::any('/practice/{n?}', [PracticeController::class, 'index']);

Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);

# Restrict using authentication
Route::group(['middleware' => 'auth'], function () {
    # Parking CRUD operatings Begin!
    /**
     * Parking App - Create
     */
#
    # Make sure the create route comes before the `/parkings/{slug}` route so it takes precedence
    Route::get('/parkings/create', [ParkController::class, 'create']);
    # Note the use of the post method in this route
    Route::post('/parkings', [ParkController::class, 'store']);
#
    /**
     * Parking App - Read
     */
#

    Route::get('/parkings', [ParkController::class, 'index']);
    Route::get('/process', [ParkController::class, 'process']);
    Route::get('/search', [ParkController::class, 'search']);

    //Route::get('/parkings/{vehicle}', [ParkController::class, 'show']);
    Route::get('/parkings/{slug}', [ParkController::class, 'show']);
    Route::get('/parkings/filter/{category}/{subcategory}', [ParkController::class, 'filter']);

    Route::get('/parking/{id}', function ($id) {
        return 'Your parking information vehicle license plate#'.$id;
    });

    /**
     * Parking Ticket - Listing
     */

    Route::get('/parking/{vehicle}', [ParkController::class, 'show']);
    Route::get('/list', [ListController::class, 'show']);
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::post('/list/{slug?}/save', [ListController::class, 'save']);


    /**
     * Parking Review or ticket to time - Update
     */
    //Show the form to edit a specific parking ticket
    Route::get('/parkings/{slug}/edit', [ParkController::class,'edit']);
    //Process the form to edit a specific parking ticket
    Route::put('/parkings/{slug}', [ParkController::class, 'update']);

    /**
     * Parking Ticket - Delete
     */

    //Show the form to confirm a specific parking ticket deletion
    Route::get('/parkings/{slug}/delete', [ParkController::class,'delete']);

    //Process the form to delete a specific parking ticket
    Route::delete('/parkings/{slug}/', [ParkController::class,'destroy']);
});
// Route group  end to restrict allowed users



/*
Route::get('/', function () {
    return view('welcome');
});
*/