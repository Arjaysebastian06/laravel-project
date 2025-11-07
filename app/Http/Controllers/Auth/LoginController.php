<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email address cannot be empty!',
            'email.email' => 'Please enter a valid email address!',
            'password.required' => 'Password cannot be empty!',
            'password.min' => 'Password must be at least 8 characters!',
        ]);

        // Attempt login
        if (Auth::attempt([
            'email_address' => $request->email,
            'password' => $request->password
        ])) {
            // Login successful - flash a success message
            return redirect()->intended('/dashboard')
                ->with('success', 'You have successfully logged in!');
        }


        // Login failed
        return back()->withErrors([
            'invalid' => 'Invalid credentials.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token for security

        return redirect('/login'); // Simply redirect without any flash message
    }
}
