<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            // Check if user already exists
            $existingUser = User::where('email', $user->email)->first();
            
            if ($existingUser) {
                // User exists, update Google ID if not set
                if (empty($existingUser->google_id)) {
                    $existingUser->update([
                        'google_id' => $user->id,
                        'avatar' => $user->avatar,
                    ]);
                }
                
                Auth::login($existingUser);
            } else {
                // Create new user
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                    'password' => Hash::make(rand(1000000, 9999999)), // Random password
                ]);
                
                Auth::login($newUser);
            }
            
            return redirect()->intended('/dashboard');
            
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }
}
