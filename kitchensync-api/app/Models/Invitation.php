<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['inviter_id', 'invitee_id', 'family_id', 'status_id'];

    public function inviter() {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    public function invitee() {
        return $this->belongsTo(User::class, 'invitee_id');
    }

    public function family() {
        return $this->belongsTo(Family::class, 'family_id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
