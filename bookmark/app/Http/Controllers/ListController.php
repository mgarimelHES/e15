<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ListController extends Controller
{
    //public function show()
    /**
     *  GET / LIST
     */
    public function show(Request $request)
    {
        $books = $request->user()->books;

        //dump($books);

        return view('list/show', ['books' => $books ]);
    }

    //public function add()
    /**
    *  GET / List/{slug}/add
    */
    public function add(Request $request, $slug)
    {
        $book = Book::findBySlug($slug);
 
        // dump($request);
 
        return view('list/add', ['book' => $book ]);
    }

    /**
    * POST /list/{slug}/save
    */
    public function save(Request $request, $slug)
    {
        # TODO: Validate incoming data, making sure they entered a note
        dump($request->all());
        
        $user = $request->user();
        $book = Book::findBySlug($slug);

        # Add book to user's list
        # (i.e. create a new row in the book_user table)
        $request->user()->books()->save($book, ['notes' => $request->notes]);

        return redirect('/list')->with([
        'flash-alert' => 'The book ' .$book->title. ' was added to your list.'
    ]);
    }
}