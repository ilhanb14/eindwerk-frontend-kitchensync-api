<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    public function invite(Request $request)
    {   
        // Validate email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Error if email is not in the right format
        if ($validator->fails()) {
            return response()->json([
                'error_code' => 'INVALID_EMAIL_FORMAT',
                'message' => 'Invalid email format',
            ], 400);
        }

        // Validate IDs
        $validator = Validator::make($request->all(), [
            'inviter_id' => 'required|exists:users,id',
            'family_id' => 'required|exists:families,id',
        ]);

        // Error if id's can't be found
        if ($validator->fails()) {
            return response()->json([
                'error_code' => 'INVALID_ID',
                'message' => 'Invalid id'
            ], 400);
        }
        
        // Check if user exists
        $invitee = User::where('email', $request->input('email'))->first();
        if (!$invitee) {
            return response()->json([
                'error_code' => 'USER_NOT_FOUND',
                'message' => 'User not found',
            ], 404);
        }

        // Check if user is already in family
        if ((string) $invitee->family_id === $request->input('family_id')) {
            return response()->json([
                'error_code' => 'USER_ALREADY_IN_FAMILY',
                'message' => 'User already in family',
            ], 400);
        }

        // Check if user is already invited by this family
        $existingInvitation = Invitation::where('invitee_id', $invitee->id)->where('family_id', $request->input('family_id'))->first();
        if ($existingInvitation) {
            return response()->json([
                'error_code' => 'USER_ALREADY_INVITED',
                'message' => 'User already invited',
            ], 400);
        }

        // Create a new invitation
        $invitation = new Invitation();
        $invitation->inviter_id = $request->input('inviter_id');
        $invitation->invitee_id = $invitee->id;
        $invitation->status_id = 1;
        $invitation->family_id = $request->input('family_id');
        $invitation->save();

        return response()->json([
            'message' => 'Invitation sent successfully!'
        ], 200);
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