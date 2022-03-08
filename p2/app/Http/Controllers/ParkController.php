<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParkController extends Controller
{
    //

    public function index()
    {
        
        //
        // query Db to return all the parkings information
        // return a view displaying all parkings
        #
        //return 'Display all parkings information from DB here!! ...';
        return view('parkings/show');
    }

    public function show($vehicle)
    {
        // query the DB from the parkings table where vehicle = $vehicle;
        // now load a view to display the vehicle info from the DB
        //
        // return 'Display Vehicle details data here ...' . $vehicle;

        $parkingFound = true;
        return view('parkings/show', [
            'vehicle' => $vehicle,
            'parkingFound' => $parkingFound
        ]);
    }

    public function filter($category, $subcategory)
    {
        return 'Show all vehicles filtered by these categories: ' . $category.','.$subcategory;
    }
}