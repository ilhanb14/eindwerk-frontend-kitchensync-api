<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikedMeal extends Model
{
    protected $fillable = ['meal_id', 'user_id'];

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'likedmeals'; 
}
