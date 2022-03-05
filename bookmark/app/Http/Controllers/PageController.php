<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        return view('pages/welcome');
    }

    public function contact()
    {
        //return '<h1>Contact us at mail@bookmark.com</h1>';
        return view('pages/contact');
    }
}