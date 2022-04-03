<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Parking; # Make sure Parking Model is accessible
use Faker\Factory; # We’ll use this library to generate random/fake data

class ParkingsTableSeeder extends Seeder
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
        //$this->addOneParking();
        //$this->addAllParkingsFromParkingsDotJsonFile();
        $this->addRandomlyGeneratedParkingsUsingFaker();
    }

    /**
     *
     */
    private function addOneParking()
    {
        $parking = new Parking();
        
        $parking->slug = 'parkingRece1pt-1';
        $parking->created_at = $this->faker->dateTimeThisMonth();
        $parking->updated_at = $parking->created_at;
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

        $parking->save();
    }

    /**
     *
     */
    private function addAllParkingsFromParkingsDotJsonFile()
    {
        $parkingData = file_get_contents(database_path('parkings.json'));
        $parkings = json_decode($parkingData, true);

        foreach ($parkings as $slug => $parkingData) {
            $parking = new Parking();

            $parking->slug = $slug;
            $parking->created_at = $this->faker->dateTimeThisMonth();
            $parking->updated_at = $parking->created_at;
            $parking->parking_lot = $parkingData['lot'];
            $parking->license_plate = $parkingData['license_plate'];
            $parking->owner =  $this->faker->firstName . ' ' . $this->faker->lastName;
            $parking->model_year =  $this->faker->year;
            $parking->parking_start_time = $parkingData['entry_time'];
            $parking->parking_end_time = $parkingData['exit_time'];
            $parking->vehicle_image = $parkingData['plate_img'];
            //$parking->make = 'Honda';
            $parking->make = $this->faker->word;
            //$parking->model = 'Civic';
            $parking->model = $this->faker->word;
            $parking->description = $this->faker->paragraphs(1, true);

            $parking->save();
        }
    }

    /**
     *
     */
    private function addRandomlyGeneratedParkingsUsingFaker()
    {
        for ($i = 0; $i < 100; $i++) {
            $parking = new Parking();
            
            $license = $this->faker->words(rand(3, 6), true);
            $parking->created_at =  $this->faker->dateTimeThisMonth();
            $parking->updated_at =  $parking->created_at;
            $parking->parking_lot = $this->faker->word;
            //$parking->parking_lot = 'Lot-West';
            $parking->license_plate = Str::title($license);
            $parking->slug = Str::slug($license, '-');
            $parking->owner = $this->faker->firstName . ' ' . $this->faker->lastName;
            $parking->model_year = $this->faker->year;
            $parking->vehicle_image = '/images/WV_ABC-999.jpg';
            //$parking->make = 'Honda';
            //$parking->model = 'Civic';
            $parking->make = $this->faker->word;
            $parking->model = $this->faker->word;
            $parking->parking_start_time = $this->faker->dateTimeThisMonth();
            $parking->parking_end_time = $parking->parking_start_time;
            $parking->description = $this->faker->paragraphs(1, true);

            $parking->save();
        }
    }
}