<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['date', 'meal_id', 'mealtime_id', 'family_id', 'account_id', 'comment'];

    // Disable timestamps
    public $timestamps = false;
}
