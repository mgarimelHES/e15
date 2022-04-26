<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Parking;
use App\Models\User;

class ParkingUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
         // Pivot table seeder info

        # Goal: Add three parkings to user jill@harvard.edu's "list"
        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        $parkings = [
        'Mur-006',
        'Mur-005',
        'Mur-012'
    ];

        foreach ($parkings as $license_plate) {
            $parking = Parking::where('license_plate', '=', $license_plate)->first();
            $user->parkings()->save($parking, ['comments' => 'I love this parking garage '. $license_plate]);
        }
    }
}