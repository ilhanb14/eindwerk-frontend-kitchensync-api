<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;

Route::post('/invitations', [InvitationController::class, 'invite']);
Route::patch('/invitations/{id}', [InvitationController::class, 'respond']);
Route::get('/invitations/{user_id}', [InvitationController::class, 'getUserInvitations']);