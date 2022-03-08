<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function welcome()
    {
        return view('pages/welcome');
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

        return view('pages/contact');
    }
}