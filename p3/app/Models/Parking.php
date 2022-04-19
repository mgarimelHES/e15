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
}