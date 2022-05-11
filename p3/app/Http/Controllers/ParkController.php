<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\Parking;
use App\Models\Customer;
use Carbon\Carbon;

class ParkController extends Controller
{
    /**
    * GET /parkings/create
    * Display the form to add vehicle information to get a new parking Receipt
    */
    public function create(Request $request)
    {
        
        # Project-3 Create page rendering Here
        # Get data for customers in alphabetical order by last name
        $customers = Customer::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();
       
        return view('parkings/create', ['customers' => $customers]);
    }

    /**
    * POST /parkings
    * Process the form for creating a new parking receipt
    */
    public function store(Request $request)
    {
        #
        # Code will eventually go here to add the parking receipt to the database,
        #
        # If validation fails, it will go back to the same form page for the user to fix the errors!
        

        $request->validate([
            'slug' => 'required|unique:parkings,slug',
            'customer_id' => 'required',
            'discountType' => 'required',
            'parkingLot' => 'required',
            'plate' => 'required',
            'make' => 'required',
            'model' => 'required',
            'terms' => 'required'
        ]);

        $parking = new Parking();
        $parking->slug = $request->slug;
        $parking->parking_lot = $request->parkingLot;
        $parking->license_plate = $request->plate;
       
        $parking->customer_id = $request->customer_id;
        $parking->model_year = $request->modelYear;
       
        dump((Carbon::parse($request->fromTime))->format('H:i'));
        $parking->parking_start_time = Carbon::parse($request->fromTime)->format('H:i');
        $parking->parking_end_time = $request->toTime;
        //$parking->vehicle_image = '/images/WV_ABC-999.jpg';
        $parking->make = $request->make;
        $parking->model = $request->model;
        $parking->description = $request->rules;

        $parking->save();

        #Redirect later to REVIEW Parking Lot Page
        return redirect('/parkings/create')->with(['flash-alert' => 'Your Parking Ticket has been created']);
    }
    /**
     * GET /process
     * Process the parking receipt using the parking receipt for future printing logic later phase
     */
    public function process(Request $request)
    {
        
        # Place holder for future process
        return 'Place Holder for future print process';
    }

    /**
     * GET /search
     * Search the parkings based on license plate(ex- Mur-005) or lot (ex- Lot-East or Lot-West)
     */
    public function search(Request $request)
    {
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # If validation fails, it will redirect back to `/` home page

        # Get the form input values (default to null if no values exist)
        $searchTerms = $request->input('searchTerms', null);
        $searchType = $request->input('searchType', null);

        # Load our json parking data and convert it to an array
        $parkingData = file_get_contents(database_path('parkings.json'));
        $parkings = json_decode($parkingData, true);
    
        # Do search
        $searchResults = [];
        foreach ($parkings as $slug => $parking) {
            if (strtolower($parking[$searchType]) == strtolower($searchTerms)) {
                $searchResults[$slug] = $parking;
            }
        }
    
        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/responses#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchTerms' => $searchTerms,
            'searchType' => $searchType,
            'searchResults' => $searchResults
        ]);
    }

    /**
     * GET /parkings
     * Show all the parkings currently occupied
     */
    public function index()
    {
        # Use database to get the customers information
        $parkings = Parking::orderBy('license_plate', 'ASC')->get();

        $newParkings = $parkings->sortByDesc('id')->take(3);

        return view('parkings/index', [
            'parkings' => $parkings,
            'newParkings' => $newParkings
        ]);
    }

    /**
     * GET /parkings/{slug}
     * Show the details for an individual parking location using slug
     */
    public function show(Request $request, $slug)
    {
        # Use database to check if the parking spot is occupied or not
        // $parking = Parking::where('slug', '=', $slug)->first();
        $parking = Parking::findBySlug($slug);
        
        if (!$parking) {
            return redirect('/parkings')->with(['flash-alert' => 'Parking is not found.']);
        }

        $onList = $parking->users()->where('user_id', $request->user()->id)->count() >= 1;

        return view('parkings/show', [
            'parking' => $parking,
            'onList' => $onList
        ]);
    }

    /**
     * GET /parkings/filter by Lot and/ or by floor
     */
    public function filter($category, $subcategory)
    {
        return 'Show all parkings in these categories: ' . $category . ' , ' . $subcategory;
    }

    /**
     * EDIT /parkings/slug for a specific parking ticket to change some allowed changes
     */
    public function edit(Request $request, $slug)
    {
        $parking = Parking::where('slug', '=', $slug)->first();
        if (!$parking) {
            return redirect('/parkings')->with(['flash-alert' => 'Parking Ticket not found.' ]);
        }

        # Get data for customers in alphabetical order by last name
        $customers = Customer::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();
       
        return view('parkings/edit', ['parking' => $parking, 'customers' =>$customers]);
    }

    /**
    * PUT /parkings/{slug}/edit
    * Update the form to update the parking ticket
    */
    public function update(Request $request, $slug)
    {
        $parking = Parking::where('slug', '=', $slug)->first();
       
        # If validation fails, it will go back to the same form page for the user to fix the errors!
        $request->validate([
        'slug' => 'required|unique:parkings,slug,'.$parking->id.'|alpha_dash',
       
        'customer_id' => 'required',
        'parkingLot' => 'required',
        'plate' => 'required',
       'make' => 'required',
        'model' => 'required',
        'terms' => 'required'
    ]);

        $parking = new Parking();
        $parking->slug = $request->slug;
        $parking->parking_lot = $request->parkingLot;
        $parking->license_plate = $request->plate;
        
        $parking->customer_id = $request->customer_id;
        $parking->model_year = $request->modelYear;
      
        $parking->parking_start_time = (Carbon::parse(($request->fromTime))->format('H:i'));
        $parking->parking_end_time = $request->toTime;

        //$parking->vehicle_image = '/images/WV_ABC-999.jpg';

        $parking->make = $request->make;
        $parking->model = $request->model;
        $parking->description = $request->rules;

        $parking->save();

        return redirect('/parkings/'.$slug.'/edit')->with(['flash-alert' => 'Your parking  has been updated.']);
    }

    /**
    * GET /books/{slug}/delete
    * Display the confirm page to delete a specific parking spot using slug
    */
    public function delete($slug)
    {
        $parking = Parking::findBySlug($slug);
        
        if (!$parking) {
            return redirect('/parkings')->with(['flash-alert' => 'Parking is not found.' ]);
        }

        return view('parkings/delete', ['parking' =>$parking]);
    }

    /**
    * Delete a spefic parking
    * DELETE /parkings/{slug}/delete
    */
    public function destroy($slug)
    {
        $parking = Parking::findBySlug($slug);

        # Before we delete the parking spot we first have to delete any relationships connected to this user like Jill
        #

        $parking->delete();

        return redirect('/parkings')->with(['flash-alert' => '"'. $parking->license_plate . '" was deleted.' ]);
    }
}