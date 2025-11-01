<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    // Redirect to provider
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle callback
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // Check if user exists
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Create new user
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(uniqid()), // Random password
            ]);
        }

        // Log in the user
        Auth::login($user, true);

        return redirect('/dashboard');
    }
}
