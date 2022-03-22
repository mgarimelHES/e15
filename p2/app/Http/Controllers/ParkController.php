<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ParkController extends Controller
{
    /**
    * GET /parkings/create
    * Display the form to add vehicle information to get a new parking Receipt
    */
    public function create(Request $request)
    {
        // return view('parkings/create');

        # Get the form input values (default to null if no values exist)
        $parkingDay = $request->input('parkingDay', null);
        $fromTime = $request->input('fromTime', null);
        $toTime = $request->input('toTime', null);
        $discountType = $request->input('discountType', null);
        $plate = $request->input('plate', null);
        $make = $request->input('make', null);
        $model = $request->input('model', null);

        # The parking receipt with the current date and given time, will be displayed along with the calculated cost!
        $parkingReceipt = $request->input('parkingReceipt', null);
        
        # Display the Parking receipt form for user to enter the values
        return view('parkings/create', [
        'parkingDay' => session('parkingDay', null),
        'fromTime' => session('fromTime', null),
        'toTime' => session('toTime', null),
        'discountType' => session('discountType', null),
        'plate' => session('plate', null),
        'make' => session('make', null),
        'model' => session('model', null),
        'parkingReceipt' => session('parkingReceipt', null)
    ]);
    }

    /**
    * POST /parkings
    * Process the form for creating a new parking receipt
    */
    public function store(Request $request)
    {
        # Code will eventually go here to add the parking receipt to the database,
        # but for now we'll just dump the form output data to the page as a place holder!!
        #
        #
        # If validation fails, it will go back to the same form page for the user to fix the errors!
        $request->validate([
            'parkingDay' => 'required|date_equals:'. date('m/d/Y'),
            'fromTime' => 'required|date_format:H:i',
            'toTime' => 'required|date_format:H:i|after:fromTime|before: 11:59 PM',
            'discountType' => 'required',
            'plate' => 'required',
            'make' => 'required',
            'model' => 'required',
            'terms' => 'required'
        ]);
        #
        # Get the form input values (default to null if no values exist)
        $parkingDay = $request->input('parkingDay', null);
        $fromTime = $request->input('fromTime', null);
        $toTime = $request->input('toTime', null);
        $discountType = $request->input('discountType', null);
        $plate = $request->input('plate', null);
        $make = $request->input('make', null);
        $model = $request->input('model', null);

        $parkingReceipt = $request->input('parkingReceipt', null);
        
        # Calculate the starting and ending hours and to process the parking duration to the nearest hour!
        #
        # Using the Carbon, the parking start and end timmes are compared in terms of hours and minutes
        $from = \Carbon\Carbon::create(substr($parkingDay, 0, 4), substr($parkingDay, 5, 2), substr($parkingDay, 8, 2), substr($fromTime, 0, 2), substr($fromTime, 3), 00);
        $to = \Carbon\Carbon::create(substr($parkingDay, 0, 4), substr($parkingDay, 5, 2), substr($parkingDay, 8, 2), substr($toTime, 0, 2), substr($toTime, 3), 00);

        # Calculate the difference in minutes between the "from Time" and "to Time"
        $minutes = $from->diffInMinutes($to);

        # From the minutes, calculate the hours, rounding up to the nearest integer since the parking is calculated on hourly basis!
        $hours = ceil($minutes / 60);
        $rate = 10;
        #
        # Calculate the discount based on the parking discount category - Student, Faculty, Staff and Visitor
        # Discount is as follows - Visitor: 0%; Student : 10%; Faculty : 20% and Staff: 30%
        #
        switch ($discountType) {
            case "visitor":
                echo "discount for visitor";
                $rate = $rate * 1.0; // No discount
                break;
            case "student":
                echo "discount for student";
                $rate = $rate * 0.9; // 10% discount
                break;
            case "faculty":
                echo "discount for faculty";
                $rate = $rate * 0.8; // 20% discount
                break;
            case "staff":
                echo "Discount for staff";
                $rate = $rate * 0.7; // 30% discount
                break;
        }
        #
        # Calculate the total parking fee using the rounded hours with the discounted rate if applicable.
        $price = $hours * $rate;

        $parkingReceipt = 'Vehicle may be parked on '. $parkingDay . '  for a total of $'. $price . ' for '. $hours . ' hours from '. $fromTime . ' to ' . $toTime . ' at a rate of $' . $rate . ' per hour';
        
        # Redirect to the same form to display the parking receipt using the results with 'parkingReceipt' along with the given input data
        #
        return redirect('parkings/create')->with([
            'parkingDay' => $parkingDay,
            'fromTime' => $fromTime,
            'toTime' => $toTime,
            'discountType' => $discountType,
            'plate' => $plate,
            'make' => $make,
            'model' => $model,
            'parkingReceipt' => $parkingReceipt
        ]);
    }
    /**
     * GET /process
     * Process the parking receipt using the parking receipt for future printing logic
     */
    public function process(Request $request)
    {
        
        // Place holder for future process
        return 'Place Holder for future process';
    }

    /**
     * GET /search
     * Search the parkings based on license plate or id
     */
    public function search(Request $request)
    {
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # If validation fails, it will redirect back to `/`

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
        # Load parking data using PHP’s file_get_contents
        # We specify the parkings.json file path using Laravel’s database_path helper
        $parkingData = file_get_contents(database_path('parkings.json'));
        
        # Convert the string of JSON text loaded from parkings.json into an
        # array using PHP’s built-in json_decode function
        $parkings = json_decode($parkingData, true);
        
        # Alphabetize the parkingss by license plates using Laravel’s Arr::sort
        $parkingss = Arr::sort($parkings, function ($value) {
            return $value['lot'];
        });

        return view('parkings/index', ['parkings' => $parkings]);
    }

    /**
     * GET /parkings/{slug}
     * Show the details for an individual vehicle
     */
    public function show($slug)
    {
        # Load book data
        # @TODO: This code is redundant with loading the parkingss in the index method
        
        $parkingData = file_get_contents(database_path('parkings.json'));
        $parkings = json_decode($parkingData, true);

    
        # Narrow down array of parkings to the single parking we’re loading
        $parking = Arr::first($parkings, function ($value, $key) use ($slug) {
            return $key == $slug;
        });

        return view('parkings/show', [
            'parking' => $parking,
        ]);
    }

    /**
     * GET /parkings/filter by Lot and/ or by floor
     */
    public function filter($category, $subcategory)
    {
        return 'Show all parkings in these categories: ' . $category . ' , ' . $subcategory;
    }
}