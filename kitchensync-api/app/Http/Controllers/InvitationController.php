<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Status;

class InvitationController extends Controller
{
    public function invite(Request $request)
    {   
        // Validate id from inviter
        $request->validate([
            'inviter_id' => 'required|exists:users,id',
            'family_id' => 'required|exists:families,id',
        ]);

        // Validate email from incoming request and get the id of the person attached
        $invitee = User::where('email', $request->validate([
            'email' => 'required|email|exists:users,email',
            ]))->first();

        // Check if user exists
        if (!$invitee) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Create a new invitation
        $invitation = new Invitation();
        $invitation->inviter_id = $request->input('inviter_id');
        $invitation->invitee_id = $invitee->id;
        $invitation->status_id = 1;
        $invitation->family_id = $request->input('family_id');
        $invitation->save();

        return response()->json(['message' => 'Invitation sent successfully!']);
    }

    public function respond($invitationId, Request $request)
    {
        // Make sure both changes or no changes happen
        return DB::transaction(function () use ($invitationId, $request) {
            
            // Find the invitation based on id
            $invitation = Invitation::findOrFail($invitationId);

            // Check if invitation is still pending
            if ($invitation->status_id !== 1) {
                return response()->json(['message' => 'You already responded to this invitation.'], 400);
            }

            // Find id of status
            $status = Status::where('status', $request->status)->firstOrFail();

            // If request is accepted, update the users family_id
            if ($request->status === 'accepted') {
                $invitee = $invitation->invitee;
                $invitee->update(['family_id' => $invitation->family_id]);
            }

            // Update status in invitations
            $invitation->status_id = $status->id;
            $invitation->save();

            return response()->json(['message' => 'Invitation responded successfully!']);
        });
    }

    public function getUserInvitations($userId)
    {
        // Get the user's invitations
        return Invitation::where('invitee_id', $userId)
            ->with(['inviter', 'family', 'status'])
            ->get();
    }
}