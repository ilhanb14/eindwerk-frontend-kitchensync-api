<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = ['type'];

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'accounttypes';
}
