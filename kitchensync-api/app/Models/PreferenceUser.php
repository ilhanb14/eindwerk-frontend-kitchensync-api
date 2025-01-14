<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PreferenceUser extends Pivot
{
    protected $fillable = [
        'user_id',
        'preference_id',
        'important'
    ];

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'preference_user';
}