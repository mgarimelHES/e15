<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;

use Str;

use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    /**
       * 20th practice example as per week12 assignment for update
       * GET /practice/20
       */

    public function practice20()
    {
        # As an example, grab a user we know has books on their list
        $user = User::where('email', '=', 'jill@harvard.edu')->first();
      
        # Grab the first book on their list
        $book = $user->books()->first();
      
        # Update and save the notes for this relationship
        $book->pivot->notes = "New note...";
        $book->pivot->save();
      
        # Confirm it worked
        return 'Update complete. Check the `book_user` table to confirm.';
    }
    
    /**
       * 19th practice example as per week12 assignment for delete
       * GET /practice/19
       */
    public function practice19()
    {
        # As an example, grab a user we know has books on their list
        $user = User::where('email', '=', 'jill@harvard.edu')->first();
      
        # Grab the first book on their list
        $book = $user->books()->first();
      
        # Delete the relationship
        $book->pivot->delete();
      
        # Confirm it worked
        return 'Delete complete. Check the `book_user` table to confirm.';
    }

    /**
       * 18th practice example as per week12 assignment of many-to-many
       * GET /practice/18
       */

    public function practice18(Request $request)
    {
        $user = User::where('email', '=', 'jamal@harvard.edu')->first();

        $book = Book::where('title', '=', 'The Martian')->first();

        $user->books()->save($book); //without notes since it can be null
    }

    
    /**
       * 17th practice example as per week12 assignment of many-to-many
       * GET /practice/17
       */

    public function practice17(Request $request)
    {
        // $books = Book::all(); // mmore queries
        // using eager loading below
        $books = Book::with('users')->get();
        
        foreach ($books as $book) {
            dump($book->title);
            foreach ($book->users as $user) {
                dump($user->toArray());
            }
        }
    }

    /**
       * 16th practice example as per week12 assignment of many-to-many
       * GET /practice/16
       */

    public function practice16(Request $request)
    {
        # Eager load users to reduce number of queries
        # (Suggestion: Try this without the `with` and watch how it greatly increases the number of queries)
        $book = Book::where('title', '=', 'The Great Gatsby')->first();
        dump($book->users->toArray());
        
        $books = Book::with('users')->get();

        foreach ($books as $book) {
            if ($book->users->count() == 0) {
                dump($book->title . ' is not on any user’s list');
            } else {
                dump($book->title . ' is on the following user’s lists:');

                foreach ($book->users as $user) {
                    dump($user->email);
                }
            }
        }
    }
     
    /**
       * 15th practice example as per week12 assignment of many-to-many
       * GET /practice/15
       */

    public function practice15(Request $request)
    {
        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        dump($user->books->toArray());

        dump($user->name . ' has the following books on their list: ');

        # Note how we can treate the `books` relationship as a dynamic propert ($user->books)
        foreach ($user->books as $book) {
            dump($book->title);
        }
    }
   
    /**
      * 14th practice example as per week11 assignment of one-to-many
      * GET /practice/14
      */

    public function practice14(Request $request)
    {
        # Eager load the author with the book
        $books = Book::with('author')->get();

        foreach ($books as $book) {
            if ($book->author) {
                dump($book->author->first_name.' '.$book->author->last_name.' wrote '.$book->title);
            } else {
                dump($book->title. ' has no author associated with it.');
            }
        }

        dump($books->toArray());
    }

    /**
     * 13th practice example as per week11 assignment of one-to-many
     * GET /practice/13
     */

    public function practice13(Request $request)
    {
        # Get an example book
        $book = Book::whereNotNull('author_id')->first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title.' was written by '.$author->first_name.' '.$author->last_name);
        dump($book->toArray());
    }

   
    /**
    * 12th practice example as per week11 assignment of one-to-many
    * GET /practice/12
    */

    public function practice12(Request $request)
    {
        $author = Author::where('first_name', '=', 'J.K.')->first();

        $book = new Book;
        $book->slug = 'fantastic-beasts-and-where-to-find-them';
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2001;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png';
        $book->info_url = 'https://en.wikipedia.org/wiki/Fantastic_Beasts_and_Where_to_Find_Them';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->description = 'Fantastic Beasts and Where to Find Them is a 2001 guide book written by British author J. K. Rowling (under the pen name of the fictitious author Newt Scamander) about the magical creatures in the Harry Potter universe. The original version, illustrated by the author herself, purports to be Harry Potter’s copy of the textbook of the same name mentioned in Harry Potter and the Philosopher’s Stone (or Harry Potter and the Sorcerer’s Stone in the US), the first novel of the Harry Potter series. It includes several notes inside it supposedly handwritten by Harry, Ron Weasley, and Hermione Granger, detailing their own experiences with some of the beasts described, and including in-jokes relating to the original series.';
        $book->save();
        dump($book->toArray());
    }

    /**
    * 11th practice example as per week11 assignment
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