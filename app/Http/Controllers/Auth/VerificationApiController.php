<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationApiController extends Controller
{

    use VerifiesEmails;

    /**
     * Mark the authenticated user’s email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        if ($request->hasValidSignature()) {

            $userID                  = $request->id;
            $user                    = User::findOrFail($userID);
            $date                    = date("Y-m-d g:i:s");
            $user->email_verified_at = $date;
            $user->save();

            return response()->json(['Email verified!']);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Resend de the email verification notification
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['User already have verified email!'], 422);
        }

        $request->user()->sendEmailVerification();
        return response()->json(['The notification has been submitted']);
    }
}