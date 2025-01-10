<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = ['name'];

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'families';
}
