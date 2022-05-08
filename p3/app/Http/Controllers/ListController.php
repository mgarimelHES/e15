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

    /**
    * PUT /list/{slug?}/update
    */
    public function update(Request $request, $slug)
    {
        $parking = Parking::findBySlug($slug);
        $user = $request->user();

        $parking = $user->parkings()->where('parkings.id', $parking->id)->first();

        $parking->pivot->comments = $request->comments;
        $parking->pivot->save();

        return redirect('/list')->with([
            'flash-alert' => 'Your comments for ' .$parking->license_plate. ' was updated.'
        ]);
    }
     
    /**
     * DELETE /list/{slug}/destroy
     */
    public function destroy(Request $request, $slug)
    {
        $parking = $request->user()->parkings()->where('slug', $slug)->first();
        
        $parking->pivot->delete();

        # Because we can delete a parking  from either the individual parking page
        # or the list page, we redirect to whatever page this request came from
        return redirect($request->headers->get('referer'))->with([
            'flash-alert' => 'The parking ' . $parking->license_plate . ' was removed from your parking list'
        ]);
    }
}