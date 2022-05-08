<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    /**
    * GET /books/create
    * Display the form to add a new book
    */
    public function create(Request $request)
    {
        
        # Get data for authors in alphabetical order by last name
        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();
       
        return view('books/create', ['authors' => $authors]);
    }

    /**
    * POST /books
    * Process the form for adding a new book
    */
    public function store(Request $request)
    {
        $request->validate([

        'title' => 'required|max:255',
        'slug' => 'required|unique:books,slug,alpha_dash',
        'author_id' => 'required',
        'published_year' => 'required|digits:4',
        'cover_url' => 'required|url',
        'info_url' => 'required|url',
        'purchase_url' => 'required|url',
        'description' => 'required|min:100'

       ]);


        //database

        $book = new Book();
        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;

        $book->save();
        
        //dump($book);

        //redirect to add another book if needed

        return redirect('/books/create')->with(['flash-alert' => 'Your book has been added.']);


        # Code will eventually go here to add the book to the database,
        # but for now we'll just dump the form data to the page for proof of concept
        //dump($request->all());
    }

    /**
     * GET /search
     * Search the books based on title or author
     */
    public function search(Request $request)
    {
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # If validation fails, it will redirect back to `/`

        # Get the form input values (default to null if no values exist)
        $searchTerms = $request->input('searchTerms', 'title');
        $searchType = $request->input('searchType', '');
       
        # Load our json book data and convert it to an array
        //$bookData = file_get_contents(database_path('books.json'));
        //$books = json_decode($bookData, true);
        $searchResults = Book::where($searchType, 'LIKE', '%'.$searchTerms.'%')->get();
    
        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/responses#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchResults' => $searchResults
        ])->withInput();
    }
    /**
     * GET /books
     * Show all the books
     */
    public function index()
    {
        /*  Comment out the following code to use database instead of json file
         # Load book data using PHP’s file_get_contents
         # We specify the books.json file path using Laravel’s database_path helper
         $bookData = file_get_contents(database_path('books.json'));

         # Convert the string of JSON text loaded from books.json into an
         # array using PHP’s built-in json_decode function
         $books = json_decode($bookData, true);

         # Alphabetize the books by title using Laravel’s Arr::sort
         $books = Arr::sort($books, function ($value) {
             return $value['title'];
         });

         return view('books/index', ['books' => $books]);
         */
        # using database
        $books = Book::orderBy('title', 'ASC')->get();

        //$newBooks = Book::orderBy('id', 'DESC')->limit(3)->get();
        
        $newBooks = $books->sortByDesc('id')->take(3);

        return view('books/index', [
            'books' => $books,
            'newBooks' => $newBooks
        ]);
    }

    /**
     * GET /books/{slug}
     * Show the details for an individual book
     */
    public function show(Request $request, $slug)
    {
        /* commented out the following code to skip reading from file, instead use database table!
        # Load book data
        # @TODO: This code is redundant with loading the books in the index method
        $bookData = file_get_contents(database_path('books.json'));
        $books = json_decode($bookData, true);

        # Narrow down array of books to the single book we’re loading
        $book = Arr::first($books, function ($value, $key) use ($slug) {
            return $key == $slug;
            return view('books/show', [
            'book' => $book,
        });

        */
        # use Database
        // $book = Book::where('slug', '=', $slug)->first();
        $book = Book::findBySlug($slug);

        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        }

        $onList = $book->users()->where('user_id', $request->user()->id)->count() >= 1;


        return view('books/show', [
            'book' => $book,
            'onList' => $onList
        ]);
    }

    /**
     * GET /books/filter
     */
    public function filter($category, $subcategory)
    {
        return 'Show all books in these categories: ' . $category . ' , ' . $subcategory;
    }

    /**
    * GET /books/{slug}/edit
    * Display the form to edit an existing book
    */
    public function edit(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        $authors = Author::getForDropdown();

        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.' ]);
        }

        return view('books/edit', [
            'book' =>$book,
            'authors' => $authors
        ]);
    }

    /**
    * PUT /books/{slug}/edit
    * Update the form to update
    */
    public function update(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();
       
        $request->validate([
            
        'title' => 'required|max:255',
        'slug' => 'required|unique:books,slug,'.$book->id.'|alpha_dash',
        'author_id' => 'required',
        'published_year' => 'required|digits:4',
        'cover_url' => 'url',
        'info_url' => 'url',
        'purchase_url' => 'url',
        'description' => 'required|min:100'


        ]);

        // update database table books

        $book->title = $request->title;
        $book->slug = $request->slug;
        // $book->author = $request->author;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;

        $book->save();
        
        return redirect('/books/'.$slug.'/edit')->with(['flash-alert' => 'Your book has been ipdated.']);
    }

    /**
    * GET /books/{slug}/delete
    * Display the confirm page to delete a specific book using slug
    */
    public function delete($slug)
    {
        $book = Book::findBySlug($slug);
        
        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.' ]);
        }

        return view('books/delete', ['book' =>$book]);
    }

    /**
    * Delete a spefic book
    * DELETE /books/{slug}/delete
    */
    public function destroy($slug)
    {
        $book = Book::findBySlug($slug);
        $book->delete();

        return redirect('/books')->with(['flash-alert' => '"'. $book->title . '" was deleted.' ]);
    }
}