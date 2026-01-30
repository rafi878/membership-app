<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $socialUser->getEmail())
                ->orWhere('google_id', $socialUser->getId())
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'google_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'membership_type' => 'A', // Default to Basic
                    'password' => bcrypt(str_random(16))
                ]);
            } else {
                $user->update([
                    'google_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'last_login' => now()
                ]);
            }

            Auth::login($user);

            return redirect()->route('dashboard')
                ->with('success', 'Logged in successfully with Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();
            
            $user = User::where('email', $socialUser->getEmail())
                ->orWhere('facebook_id', $socialUser->getId())
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'facebook_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'membership_type' => 'A', // Default to Basic
                    'password' => bcrypt(str_random(16))
                ]);
            } else {
                $user->update([
                    'facebook_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'last_login' => now()
                ]);
            }

            Auth::login($user);

            return redirect()->route('dashboard')
                ->with('success', 'Logged in successfully with Facebook!');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Facebook authentication failed: ' . $e->getMessage());
        }
    }
}