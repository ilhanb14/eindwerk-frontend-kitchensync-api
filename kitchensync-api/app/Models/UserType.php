<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $fillable = ['type'];

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'usertypes';
}
