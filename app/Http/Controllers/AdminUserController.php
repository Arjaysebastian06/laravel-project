<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function store(Request $request)
    {
        // Validate inputs with user-friendly messages
        $request->validate([
            'fullname' => 'required|string|max:50',
            'email_address' => 'required|email|unique:registration,email_address',
            'date_of_birth' => [
                'required',
                'date',
                'before:' . now()->subDays(1)->format('Y-m-d'), // not today
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'), // at least 18
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*]/',
                'confirmed', // checks if password_confirmation matches
            ],
            'password_confirmation' => 'required|string',
        ], [
            // Full name
            'fullname.required' => 'Please enter the user’s full name.',
            'fullname.max' => 'Full name cannot exceed 50 characters.',

            // Email
            'email_address.required' => 'Please enter the user’s email address.',
            'email_address.email' => 'Please enter a valid email address.',
            'email_address.unique' => 'This email is already registered. Please use another.',

            // Date of birth
            'date_of_birth.required' => 'Please enter the user’s date of birth.',
            'date_of_birth.date' => 'Please enter a valid date for the date of birth.',
            'date_of_birth.before' => 'Date of birth cannot be today or in the future.',
            'date_of_birth.before_or_equal' => 'User must be at least 18 years old.',

            // Password
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character (!@#$%^&*).',
            'password.confirmed' => 'Passwords do not match. Please confirm your password.',

            // Confirm password
            'password_confirmation.required' => 'Please confirm the user’s password.',
        ]);

        // Create user
        User::create([
            'fullname' => $request->fullname,
            'email_address' => $request->email_address,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User added successfully!');
    }
}
