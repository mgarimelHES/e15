<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * custom method
     */

    
    public function author()
    {
        # Book belongs to Author
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Models\Author');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')
        ->withTimestamps() # Must be added to have Eloquent update the created_at/updated_at columns in a pibot table
        ->withPivot('notes'); # Must also specify any other fields that should be included when fetching this relationship
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    public function isModern()
    {
        # check if the book published year is after Y2K
        #
        return $this->published_year> 2000;
    }
}