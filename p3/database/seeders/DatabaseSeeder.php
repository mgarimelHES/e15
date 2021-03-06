<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CustomersTableSeeder::class);
        $this->call(ParkingsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ParkingUserTableSeeder::class);
    }
}