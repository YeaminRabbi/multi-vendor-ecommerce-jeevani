<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $account = Account::firstOrCreate(
            [
                'id' => $user->id,
                'username' => $user->email,
                'type' => 'account',     // Attributes to set if creating a new record
                'name' => $user->name,
                'email' => $user->email,
                'is_login' => 1,
                'is_active' => 1,
            ]
        );

        // Save the current session ID before login
        $sessionId = session()->getId();

        $user->assignRole('user');

        session()->setId($sessionId);
        session()->save(); 

        // Store the email in the session
        session()->put('email', $user->email);

        return redirect()->route('account.verify')->with('verify', 'A verification link has been sent to your email address.');
    }

    public function verify(Request $request){

        $resent = $request->query('resent', false);

        if(!$resent){
            self::verifyMail($request);
        }

        return view('frontend.pages.account.verify');
    }

    public static function verifyMail(Request $request){
         // Retrieve email from session
        $email = session('email');

        if (!$email) {
            return redirect()->route('register')->with('error', 'Session expired, please register again.');
        }

        // Generate a unique token and store it in session or cookie
        $token = session('verification_token') ? session('verification_token') : Str::random(64);
        
        session(['verification_token' => $token]);

        // Send verification email with the token
        Notification::route('mail', $email)->notify(new VerifyEmailNotification($token));

        return back()->with('verify', 'A verification link has been sent to your email address.');
    }

    public function verifyToken(Request $request, $token)
    {
        // Check if the token matches the one stored in session
        if (session('verification_token') === $token) {
            // Retrieve the email from session
            $email = session('email');

            // Find the user by email
            $user = User::where('email', $email)->first();

            if ($user) {
                
                $user->update([
                    'email_verified_at' => now()
                ]);

                // Log in the user
                Auth::login($user);

                // Clear the session token and email
                session()->forget(['verification_token', 'email']);

                return redirect()->intended(route('account.order'));
            }

            return redirect()->route('login')->with('error', 'User not found.');
        }

        return redirect()->route('login')->with('error', 'Invalid or expired verification token.');
    }
}
