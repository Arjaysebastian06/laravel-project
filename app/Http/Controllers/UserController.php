<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Get all users from the database
        $users = User::all(); // Or paginate(10) if needed

        // Pass users to the view
        return view('dashboard', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting the currently logged-in user
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard')
                ->with('error', 'You cannot delete the currently logged-in user.');
        }

        $user->delete();

        return redirect()->route('dashboard')
            ->with('success', 'User deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation with user-friendly messages
        $request->validate([
            'fullname' => 'required|string|max:50',
            'email_address' => 'required|email|unique:registration,email_address,' . $id,
            'date_of_birth' => [
                'required',
                'date',
                'before:' . now()->subDays(1)->format('Y-m-d'), // Not today or future
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'), // At least 18 years old
            ],
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
        ]);

        // Fill the user with new data
        $user->fill([
            'fullname' => $request->fullname,
            'email_address' => $request->email_address,
            'date_of_birth' => $request->date_of_birth,
        ]);

        // Check if any changes were made
        if (!$user->isDirty()) {
            // No changes were made
            return redirect()->back()->with('info', 'No changes were made to the user.');
        }

        // Save changes
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }
}
