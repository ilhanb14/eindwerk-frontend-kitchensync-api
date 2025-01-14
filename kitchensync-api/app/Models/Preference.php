<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'name'
    ];

    // Disable timestamps
    public $timestamps = false;

    // Set the table name, this is by default preferences if model name is Preference
    // protected $table = 'preferences';

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('important');
    }
}