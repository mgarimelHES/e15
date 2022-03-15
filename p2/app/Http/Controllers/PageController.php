<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function welcome()
    {
        //return view('pages/welcome');
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
        //return '<h1>Contact us at mail@yourparking.com</h1>';
        
        return view('pages/contact');
    }
    //Test Murthy
    public function process()
    {
        //return view('pages/welcome');
        # If there is data stored in the session as the results of doing a search
        # that data will be extracted from the session and passed to the view
        # to display the results
        return view('parkings/create', [
            'searchTerms' => session('searchTerms', null),
            'searchType' => session('searchType', null),
            'fromTime' => session('fromTime', null)
        ]);
    }
}