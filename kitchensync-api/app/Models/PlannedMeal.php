<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlannedMeal extends Model
{
    protected $fillable = ['meal_id', 'family_id', 'date', 'mealtime_id', 'servings'];

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'plannedmeals'; 
}