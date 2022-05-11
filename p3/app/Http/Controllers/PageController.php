<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function welcome()
    {
        #
        # If there is data stored in the session as the results of doing a search
        # that data will be extracted from the session and passed to the view
        # to display the results
        
        return view('pages/welcome', [
            'searchTerms' => session('searchTerms', null),
            'searchType' => session('searchType', null),
            'searchResults' => session('searchResults', null)
        ]);
    }

    public function contact()
    {
        # Return the view to display the support contact information for the Parking application
        return view('pages/contact');
    }
}