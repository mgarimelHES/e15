<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Str;

use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    /**
    * Tenth practice example as per week11 assignment
    * GET /practice/11
    */
    public function practice11(Request $request)
    {
        # Retrieve the currently authenticated user via the Auth facade
        $user = Auth::user();
        dump($user->toArray());

        # Retrieve the currently authenticated user via request object
        //$user = $request->user();
        // dump($user->toArray());

        # Check if the user is logged in
        if (Auth::check()) {
            dump('The user ID is '.Auth::id());
        }
    }
    
    /**
    * Tenth practice example as per week9 assignment
    * GET /practice/10
    */
    public function practice10()
    {
        dump('This is the tenth example.');
        //dump(DB::select('SHOW DATABASES;'));
        //$book = Book::where('author', '=', 'Dr. Seuss')->get();
        //$book->delete();
        //dump('Book deleted.');
        //$books = Book::where('author', 'LIKE', '%Weir%')->get();
        //foreach ($books as $book) {
        //   dump($book->title);
        //}
        $book = Book::where('author', 'LIKE', '%Rowling%')->first();
        dump($book->author);
        dump('Done');
    }
    
    
    /**
        * Ninth practice example
        * GET /practice/9
        */
    public function practice9()
    {
        # Get all rows
        //$result = Book::all();
        //dump($result->toArray());
        # 1. Retrieve the last 2 books that were added to the books table.
        //$result = Book::where('published_year', '>', 2020)->limit(2)->get();
        //dump($result->toArray());
        # 2. Retrieve all the books published after 1950.
        //$result = Book::where('published_year', '>', 1950)->get();
        //dump($result->toArray());
        # 3. Retrieve all the books in alphabetical order by title.
        //$result = Book::orderBy('title', 'asc')->get();
        //dump($result->toArray());
        # 4. Retrieve all the books in descending order according to published year.
        //$result = Book::orderBy('published_year', 'desc')->get();
        //dump($result->toArray());
        # 5. Find any books by the author “J.K. Rowling” and update the author name to be “JK Rowling”
        /*
         $books = Book::where('author', '=', 'J.K. Rowling')->get();

         if (!$books) {
             dump("Book not found, can not update.");
         } else {
             # Change some properties (1 props) using for each loop
             foreach ($books as $book) {
                 $book->author = 'JK Rowling';

                 # Save the changes
                 $book->save();
             }
             dump('Update complete');
         }
         */
        # Remove any/all books with an author name that includes the string “Rowling”
        //$books = Book::where('author', 'LIKE', '%Rowling%')->get();
        //dump($books->toArray());
        #6. Delete any rows matching a `where` constraint
        // $result = Book::where('author', 'LIKE', '%Rowling%')->delete();
        // dump($result);
        //TEST WEEK 10 assignment
        //$books = Book::orderBy('id', 'desc')->get();
        //$book = $books->first();
        //dump($book);
        $books = Book::get();
        dump($books);
        $books2 = Book::all();
        echo $books2;

        //END Week10
    }
    

    /**
        * Eighth practice example
        * GET /practice/8
        */
    public function practice8()
    {
        dump('This is the eigthth example.');

        # First get a book to delete
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete');
        }

        # Query for books by F. Scott Fitzgerald to confirm the above deletion worked as expected
        # This should yield an empty array
        dump(Book::where('author', '=', 'F. Scott Fitzgerald')->get()->toArray());
    }

    /**
        * Seventhth practice example
        * GET /practice/7  --  Update sample2 using 'get' all results
        */
    public function practice7()
    {
        dump('This is the seventh example.');
        # First get a book to update
        $books = Book::where('author', '=', 'J.K. Rowling')->get();
    
        if (!$books) {
            dump("Book not found, can not update.");
        } else {
            # Change some properties (1 props) using for each loop
            foreach ($books as $book) {
                $book->author = 'JK Rowling';
            
                # Save the changes
                $book->save();
            }
            dump('Update complete');
        }
    
        # Output books to confirm the above query worked as expected
        dump(Book::orderBy('published_year')->get()->toArray());
    }

    /**
        * Sixth practice example
        * GET /practice/6  --  Update sample1 get the 'first' record
        */
    public function practice6()
    {
        dump('This is the sixth example.');
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can not update.");
        } else {
            # Change some properties (2 props)
            $book->title = 'The Really Great Gatsby';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete');
        }

        # Output books to confirm the above query worked as expected
        dump(Book::orderBy('published_year')->get()->toArray());
    }
    
    /**
        * Fifth practice example
        * GET /practice/5
        */
    public function practice5()
    {
        dump('This is the fifth example.');
        $book = new Book();  # instantiate a new Book
        # create a LIKE statement to get all the books satisfying the condition
        //$book->where('title', 'LIKE', '%Harry Potter%')->get();
        # assign values to a variable
        //$books = $book->where('title', 'LIKE', '%Harry Potter%')->get();
        // $books = $book->where('title', 'LIKE', '%Harry Potter%')->where('published_year', '>', 1998)->get();
        //$books = $book->where('title', 'LIKE', '%Harry Potter%')->orWhere('published_year', '>', 1998)->get();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->orWhere('published_year', '>', 1998)->select('title')->get();
        dump($books->toArray());
    }

    /**
    * Fourth practice example
    * GET /practice/4
    */
    public function practice4()
    {
        dump('This is the fourth example.');
        $book = new Book();  # instantiate a new Book

        # Set the properties
        # Note how each property corresponds to a column in the table
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author = 'Anthony Weir';
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        # Confirm results
        dump('The book '. $book->title . ' was added');
        dump(Book::all()->toArray());
    }
    
    /**
    * Third practice example
    * GET /practice/3
    */
    public function practice3()
    {
        dump('This is the third example.');
        dump(DB::select('SHOW DATABASES;'));
    }
    

    /**
    * Second practice example
    * GET /practice/2
    */
    public function practice2()
    {
        dump('This is the second example.');
        dump(config('app.timezone'));
    }
    
    /**
     * First practice example
     * GET /practice/1
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://bookmark.yourdomain.com.loc/practice => Shows a listing of all practice routes
     * http://bookmark.yourdomain.com.loc/practice/1 => Invokes practice1
     * http://bookmark.yourdomain.com.loc/practice/5 => Invokes practice5
     * http://bookmark.yourdomain.com.loc/practice/999 => 404 not found
     */
    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            //return view('practice')->with(['methods' => $methods]);
            // return view per week9 to list the table
            return view('practice')->with([
                'methods' => $methods,
                'books' => Book::all(),
                'fields' => [
                    'id', 'updated_at', 'created_at', 'slug', 'title', 'author', 'published_year'
                ]
            ]);
        }
    }
}