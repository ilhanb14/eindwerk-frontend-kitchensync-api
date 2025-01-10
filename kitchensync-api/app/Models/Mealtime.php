<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mealtime extends Model
{
    protected $fillable = ['mealtime'];

    // Disable timestampts
    public $timestamps = false;
}
