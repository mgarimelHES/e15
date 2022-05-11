<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function parkings()
    {
        # Customer may park many vehicles in a parking garage!
        # Define a one-to-many relationship.
        return $this->hasMany('App\Models\Parking');
    }

    /**
     *  Get customer drop list
     */
    public static function getForDropdown()
    {
        # Get data of customers in alphabetical order by last name
        return self::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();
    }
}