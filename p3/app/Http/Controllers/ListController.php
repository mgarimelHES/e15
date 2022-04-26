<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;

class ListController extends Controller
{
    public function show(Request $request)
    {
        $parkings = $request->user()->parkings;

        return view('list/show', ['parkings' => $parkings ]);
    }

    /**
    *  GET / List/{slug}/add
    */
    public function add(Request $request, $slug)
    {
        $parking = Parking::findBySlug($slug);
 
        // dump($request);
 
        return view('list/add', ['parking' => $parking ]);
    }

    /**
    * POST /list/{slug}/save
    */
    public function save(Request $request, $slug)
    {
        # TODO: Validate incoming data, making sure they entered a note
        dump($request->all());
        
        $user = $request->user();
        $parking = Parking::findBySlug($slug);

        # Add parking to user's list
        # (i.e. create a new row in the pivot parking_user table)
        $request->user()->parkings()->save($parking, ['comments' => $request->comments]);

        return redirect('/list')->with([
        'flash-alert' => 'The parking ' .$parking->license_plate. ' was added to your parking list.'
    ]);
    }
}