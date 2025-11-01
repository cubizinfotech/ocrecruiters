<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        // Find the user from the ID in the URL
        $user = User::findOrFail($id);

        // Validate the signed link
        if (! URL::hasValidSignature($request)) {
            abort(403, 'Invalid or expired verification link.');
        }

        // Ensure hash matches the user's email
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification hash.');
        }

        // If already verified, just redirect
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        // Mark the user’s email as verified
        $user->markEmailAsVerified();

        // Fire the Verified event
        event(new Verified($user));

        // Optionally log in the user after verifying
        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
