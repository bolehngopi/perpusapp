<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Get the authenticated user
        // dd($user);
        return view('account.show', compact('user'));
    }

    // Show the Edit Profile form
    public function edit()
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    // Handle the form submission for profile update
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the input fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        // Update the user's data
        $user->update($validated);

        return redirect()->route('account.show')->with('success', 'Profile updated successfully!');
    }
}
