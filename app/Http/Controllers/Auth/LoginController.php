<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Support\Facades\Notification;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Save the current session ID before login
        $sessionId = session()->getId();

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password), $remember_me)) {

            $user = Auth::user();

            // Check if the user has verified their email
            if (!$user->hasVerifiedEmail()) {

                // Generate a unique token and store it in session or cookie
                $token = session('verification_token') ? session('verification_token') : Str::random(64);
                
                session(['verification_token' => $token, 'email' => $user->email]);

                // Send verification email with the token
                Notification::route('mail', $user->email)->notify(new VerifyEmailNotification($token));
                
                Auth::logout();
                return back()->with('error', 'Verification mail has been sent, please verify your email address before logging in.');
            }

            // Regenerate the session ID and assign the old one back
            session()->setId($sessionId);
            session()->save(); // Save the session with the old ID

            return redirect()->intended(route('account.order'));
        }

        return back()->with('error', "These credentials doesn't match with our records");
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        
        return redirect()->route('home');
    }
}
