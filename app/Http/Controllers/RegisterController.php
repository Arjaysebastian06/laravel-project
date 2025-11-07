<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'fullname' => 'required|string|max:50',
            'email_address' => 'required|email|unique:registration,email_address',
            'date_of_birth' => [
                'required',
                'date',
                'before:' . now()->subDays(1)->format('Y-m-d'),
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*]/',
                'confirmed',
            ],
            'password_confirmation' => 'required|string',
            'captcha' => 'required|captcha',
        ], [
            'fullname.required' => 'Please enter your full name.',
            'email_address.required' => 'Please enter your email address.',
            'email_address.email' => 'Please enter a valid email address.',
            'email_address.unique' => 'This email is already registered.',
            'date_of_birth.required' => 'Please enter your date of birth.',
            'date_of_birth.before' => 'Date of birth cannot be today or in the future.',
            'date_of_birth.before_or_equal' => 'You must be at least 18 years old.',
            'password.required' => 'Password cannot be empty.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.regex' => 'Password must contain at least one uppercase letter, number, and special character.',
            'password.confirmed' => 'Password and confirm password do not match.',
            'password_confirmation.required' => 'Please confirm your password.',
            'captcha.required' => 'Captcha is required.',
            'captcha.captcha' => 'Captcha is incorrect, please try again.',
        ]);

        // Check for similar full name or email_address
        $similarUser = User::where('fullname', $request->fullname)
            ->orWhere('email_address', $request->email_address)
            ->first();

        if ($similarUser) {
            return back()->withErrors([
                'fullname' => 'A user with a similar full name or email address already exists.'
            ])->withInput();
        }

        // Save new user
        User::create([
            'fullname' => $request->fullname,
            'email_address' => $request->email_address,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registration successful! You can now log in.');
    }
}
