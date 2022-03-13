<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        //return '<h1>Contact us at mail@bookmark.com</h1>';
        
        //var_dump(storage_path('temp'));
        //var_dump(config('app.timezone'));
        //dd(app_path());
        //var_dump(Str::plural('mouse'));
        //var_dump(public_path('css/books/show.css'));
        //Log::info('Showing the user profile for user: '. 'HERE!!');
        //dd(public_path());
        # Hard coding the values for this example to 6am → 7:45am,
        $from = \Carbon\Carbon::create(2022, 3, 8, 6, 00, 00);
        $to = \Carbon\Carbon::create(2022, 3, 8, 7, 45, 00);

        # Calculate the difference in minutes between the "from" and "to" time
        $minutes = $from->diffInMinutes($to);

        # From the minutes, calculate the hours, rounding up
        $hours = ceil($minutes / 60);

        //dump($hours); # Should yield 2

        return view('pages/contact');
    }
}