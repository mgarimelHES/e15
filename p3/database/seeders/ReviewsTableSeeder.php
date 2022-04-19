<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Review; # Make sure Review Model is accessible
use Faker\Factory; # We’ll use this library to generate random/fake data

class ReviewsTableSeeder extends Seeder
{
    private $faker;

    /**
     * This run method is the first method you should have in all your Seeder class files
     * This method will be invoked when we invoke this seeder
     * In this method you should put code that will cause data to be entered into your tables
     * (in this case, that's the `books` table)
     */
    public function run()
    {
        # https://fakerphp.github.io
        $this->faker = Factory::create();


        # Three different examples of how to add books

        //$this->addOneReview();
        //$this->addAllReviewsFromReviewsDotJsonFile();
        $this->addRandomlyGeneratedReviewsUsingFaker();
    }

    /**
     *
     */
    private function addOneReview()
    {
        $review = new Review();
        
        $review->slug = 'parkingReview-1';
        $review->created_at = $this->faker->dateTimeThisMonth();
        $review->updated_at = $review->created_at;
        $review->parking_lot = 'Lot-East';
        $review->first_name = 'John';
        $review->last_name = 'Smith';
        $review->rating = 0;
        $review->recommended = false;
        // Any other fields??
        $review->content = ' The Parking is not in a good location, it is not a covered parking';

        $review->save();
    }

    /**
     *
     */
    private function addAllReviewsFromReviewsDotJsonFile()
    {
        $reviewData = file_get_contents(database_path('reviews.json'));
        $reviews = json_decode($reviewData, true);

        foreach ($reviews as $slug => $reviewData) {
            $review = new Review();
           
            $review->slug = $slug;
            $review->created_at = $this->faker->dateTimeThisMonth();
            $review->updated_at = $review->created_at;
            $review->parking_lot = $reviewData['parking_lot'];
            $review->first_name = $reviewData['first_name']; // John
            $review->last_name = $reviewData['last_name']; // Smith
            $review->rating =  $reviewData['rating']; // rating between 1 to 5
            $review->recommended =  $reviewData['recommended'];
            // Any other fields??
            $review->content = $reviewData['content'];

            $review->save();
        }
    }

    /**
     *
     */
    private function addRandomlyGeneratedReviewsUsingFaker()
    {
        for ($i = 0; $i < 100; $i++) {
            $review = new Review();
            //..
          
            $review->parking_lot = $this->faker->word;
            $review->slug = Str::slug($review->parking_lot) .'-' . $this->faker->word;
            $review->created_at = $this->faker->dateTimeThisMonth();
            $review->updated_at = $review->created_at;
           
            $review->first_name = $this->faker->firstName; // John
            $review->last_name = $this->faker->lastName; // Smith
            $review->rating =  $this->faker->numberBetween(1, 5); // rating between 1 to 5
            $review->recommended =  $this->faker->boolean();
            // Any other fields??
            $review->content = $this->faker->paragraphs(1, true);

            // $license = $this->faker->words(rand(3, 6), true);
            //$parking->parking_lot = 'Lot-West';
            

            $review->save();
        }
    }
}