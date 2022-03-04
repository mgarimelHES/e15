<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //

    public function index()
    {
        
        //
        // query Db to return all the books
        // return a view displaying all books
        return 'Display all books here ...';
    }

    public function show($title)
    {
        // query the DB from the books table where title = $title;
        // now load a view to display the book info from the DB
        return 'Display Book details data here ...' . $title;
    }

    public function filter($category, $subcategory)
    {
        return 'Show all books filtered by these categories: ' . $category.','.$subcategory;
    }
}