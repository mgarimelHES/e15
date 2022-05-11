<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;
    /**
    * custom method to find parking by slug
    */
    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }
    /**
        * custom method to find parking for a customer
        */
    public function customer()
    {
        # Parking belongs to a Customer
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Models\Customer');
    }
    /**
        * custom method to find pivot information by slug
        */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')
        ->withTimestamps() # Must be added to have Eloquent update the created_at/updated_at columns in a pibot table
        ->withPivot('comments'); # Must also specify any other fields that should be included when fetching this relationship
    }
}