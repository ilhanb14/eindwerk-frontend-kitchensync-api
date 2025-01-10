<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'first_name', 
        'last_name', 
        'family_id', 
        'email', 
        'account_type_id'
    ];

    // Disable timestamps
    public $timestamps = false;

    // Set the table name, this is by default accounts if model name is Account
    // protected $table = 'accounts'; 

    public function preferences()
    {
        return $this->belongsToMany(Preference::class)
            ->withPivot('important');
    }
}