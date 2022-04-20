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
}