<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Customer;
use Faker\Factory; #

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        # https://fakerphp.github.io
        $this->faker = Factory::create();

        # Array of customer data to add
        $customers = [
        ['J. Smith', 'John', 2018, ' John is a platinum memmber, he prefers East parking lot'],
        ['Jane', 'Smith', 2015, 'Jane is a gold member, she has SUV and prefers big parking lot '],
        ['Maya', 'Angel', 2021, 'Maya is a regular member and prefers a discounted price, any lot is fine'],
        ['R.K.', 'McCoy', 2020, 'R. K.  is a bronze member and prefers to park at the North lot'],
        ['Anthony', 'Weir', 2019, 'Andy Weir is a new member and right now he is in free promotion'],
        ['Amy', 'Tan', 2014, 'Amy Tan is not a member, but she was a member before'],
    ];

        $count = count($customers);

        # Loop through each customer, adding them to the parking database
        foreach ($customers as $customerData) {
            $customer = new Customer();
        
            $customer->created_at = $this->faker->dateTimeThisMonth();
            $customer->updated_at = $this->faker->dateTimeThisMonth();
            $customer->first_name = $customerData[0];
            $customer->last_name = $customerData[1];
            $customer->membership_year = $customerData[2];
            $customer->customer_profile = $customerData[3];
        
            $customer->save();
        
            $count--;
        }
    }
}