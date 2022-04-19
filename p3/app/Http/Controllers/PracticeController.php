<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Parking;
use App\Models\Review;

use Str;
use Illuminate\Support\Facades\Auth;

class PracticeController extends Controller
{
    /**
        * 11h practice example - check user info
        * GET /practice/11
        */
    public function practice11(Request $request)
    {
        # Retrieve the currently authenticated user via the Auth facade
        $user = Auth::user();
        dump($user->toArray());

        # Retrieve the currently authenticated user via request object
        $user = $request->user();
        dump($user->toArray());

        # Check if the user is logged in
        if (Auth::check()) {
            dump('The user ID is '.Auth::id());
        }
    }
    
    /**
         * Tenth practice example - Review for reviews table
         * GET /practice/10
         */
    public function practice10()
    {
        # Instantiate a new Review Model object
        $review = new Review();
        
        # Set the properties
        # Note how each property corresponds to a column in the table-reviews
        $review->slug = 'parkingReview-1';
        $review->first_name = 'John';
        $review->last_name = 'Doe';
        $review->parking_lot = 'Lot-West';
        $review->rating = 4;
        $review->recommended = false;
        $review->content = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';
        
        # Invoke the Eloquent `save` method to generate a new row in the
        # `reviews` table, with the above data
        $review->save();
        
        # Confirm results
        dump('Added: ' . $review->parking_lot);
        dump(Review::all()->toArray());
    }
    
    /**
        * Ninth practice example
        * GET /practice/9
        */
    public function practice9()
    {
        # Get all rows
        // $result = Parking::all();
        //  dump($result->toArray());
        //
        //dump reviews all
        $reviews = Review::all();
        dump($reviews->toArray());
        //
        # 1. Retrieve the last 2 parkings that were added to the parkings table.
        //$result = Parking::where('model_year', '>', 2010)->limit(2)->get();
        //dump($result->toArray());
        # 2. Retrieve all the parkings that are parked after 1950.
        //$result = Parking::where('model_year', '>', 1950)->get();
        //dump($result->toArray());
        # 3. Retrieve all the parkings in alphabetical order by make.
        //$result = Parking::orderBy('make', 'asc')->get();
        //dump($result->toArray());
        # 4. Retrieve all the parkings in descending order according to published year.
        //$result = Parking::orderBy('model_year', 'desc')->get();
        //dump($result->toArray());
        # 5. Find any parkings by the owner “Anthony Weir” and update the owner name to be “Anthony W.”
        /*
        $parkings = Parking::where('owner', '=', 'Anthony Weir')->get();

        if (!$parkings) {
            dump("Parking is not found, can not update.");
        } else {
            # Change some properties (1 props) using for each loop
            foreach ($parkings as $parking) {
                $parking->owner = 'Anthony W.';

                # Save the changes
                $parking->save();
            }
            dump('Update complete');
        }
         */
        # Remove any/all parkings with an owner name that includes the string “Weir”
        //$parkings = Parking::where('owner', 'LIKE', '%Weir%')->get();
        //dump($parkings->toArray());
        #6. Delete any rows matching a `where` constraint
        //$result = Parking::where('owner', 'LIKE', '%Weir%')->delete();
        //dump($result);
    }
    

    /**
        * Eighth practice example
        * GET /practice/8
        */
    public function practice8()
    {
        dump('This is the eigthth example.');

        # First get a parking to delete
        $parking = Parking::where('owner', '=', 'Anthony W.')->first();

        if (!$parking) {
            dump('Did not delete- Parking is not found.');
        } else {
            $parking->delete();
            dump('Deletion complete');
        }

        # Query for parkings by owner Anthony Weir to confirm the above deletion worked as expected
        # This should yield an empty array
        dump(Parking::where('owner', '=', 'Anthony W.')->get()->toArray());
    }

    /**
        * Seventhth practice example
        * GET /practice/7  --  Update sample2 using 'get' all results
        */
    public function practice7()
    {
        dump('This is the seventh example.');
        # First get a parking to update
        $parkings = Parking::where('owner', '=', 'Anthony Weir')->get();
    
        if (!$parkings) {
            dump("Parking not found, can not update.");
        } else {
            # Change some properties (1 props) using for each loop
            foreach ($parkings as $parking) {
                $parking->owner = 'Anthony W.';
            
                # Save the changes
                $parking->save();
            }
            dump('Update complete');
        }
    
        # Output parkings to confirm the above query worked as expected
        dump(Parking::orderBy('model_year')->get()->toArray());
    }

    /**
        * Sixth practice example
        * GET /practice/6  --  Update sample1 get the 'first' record
        */
    public function practice6()
    {
        dump('This is the sixth example.');
        # First get a parking to update
        $parking = Parking::where('owner', 'LIKE', '%Anthony%')->first();

        if (!$parking) {
            dump("Parking not found, can not update.");
        } else {
            # Change some properties (2 props)
            $parking->model= 'Accord';
            $parking->model_year = 2022;

            # Save the changes
            $parking->save();

            dump('Update complete');
        }

        # Output parkings to confirm the above query worked as expected
        dump(Parking::orderBy('model_year')->get()->toArray());
    }
    
    /**
        * Fifth practice example
        * GET /practice/5
        */
    public function practice5()
    {
        dump('This is the fifth example.');
        $parking = new Parking();  # instantiate a new Parking
        # create a LIKE statement to get all the parkings satisfying the condition
        $parkings = $parking->where('model', 'LIKE', '%Civ%')->get();
        dump($parkings);
        # assign values to a variable
        //$parkings = $parking->where('make', 'LIKE', '%Toy%')->get();
        // $parkings = $parking->where('make', 'LIKE', '%Hon%')->where('model_year', '>', 1998)->get();
        //$parkings = $parking->where('model', 'LIKE', '%Civi%')->orWhere('model_year', '>', 1998)->get();
        //$parkings = $parking->where('make', 'LIKE', '%Hond%')->orWhere('model_year', '>', 1998)->select('parking_lot')->get();
        //dump($parkings->toArray());
    }

    /**
    * Fourth practice example
    * GET /practice/4
    */
    public function practice4()
    {
        dump('This is the fourth example.');
        $parking = new Parking();  # instantiate a new Parking ticket

        # Set the properties
        # Note how each property corresponds to a column in the table
        $parking->slug = 'parkingRece1pt-1';
        $parking->parking_lot = 'Lot-East';
        $parking->license_plate = 'abc-999';
        $parking->owner = 'Anthony Weir';
        $parking->model_year = 2011;
        $parking->parking_start_time = '2022-04-01 01:23:45';
        $parking->parking_end_time = '2022-04-01 03:01:01';
        $parking->vehicle_image = '/images/WV_ABC-999.jpg';
        $parking->make = 'Honda';
        $parking->model = 'Civic';
        $parking->description = ' The Parking is at owners discretion, we are not responsible for any damage to your vehicle';
        
        # Invoke the Eloquent `save` method to generate a new row in the
        # `parkings` table, with the above data
        $parking->save();

        # Confirm results
        dump('The parking '. $parking->license_plate . ' was added');
        dump(Parking::all()->toArray());
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
     * http://e15p3.yourdomain.com.loc/practice => Shows a listing of all practice routes
     * http://e15p3.yourdomain.com.loc/practice/1 => Invokes practice1
     * http://e15p3.yourdomain.com.loc/practice/5 => Invokes practice5
     * http://e15p3.yourdomain.com.loc/practice/999 => 404 not found
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
            // return view per week9 to list the parkings table
            return view('practice')->with([
                'methods' => $methods,
                'parkings' => Parking::all(),
                'fields' => [
                    'id', 'updated_at', 'created_at', 'slug', 'parking_lot', 'license_plate', 'owner', 'model_year', 'make', 'model', 'parking_start_time', 'parking_end_time', 'vehicle_image'
                ]
            ]);
        }
    }
}