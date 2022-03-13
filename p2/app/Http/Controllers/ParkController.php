<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ParkController extends Controller
{
    /**
    * GET /parkings/create
    * Display the form to add a new parking Receipt
    */
    public function create(Request $request)
    {
        return view('parkings/create');
    }

    /**
    * POST /parkings
    * Process the form for adding a new parking request
    */
    public function store(Request $request)
    {
        # Code will eventually go here to add the parking receipt to the database,
        # but for now we'll just dump the form data to the page as a place holder!
        dump($request->all());
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
        //
        //var_dump($parking);
        //

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