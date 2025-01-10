<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AccountPreference extends Pivot
{
    protected $fillable = [
        'account_id',
        'preference_id',
        'important'
    ];

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'account_preference';
}