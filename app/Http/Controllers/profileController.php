<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display the authenticated user's profile
     */
    public function show()
    {
        $user = auth()->user();
        
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the user's profile
     */
    public function edit()
    {
        $user = auth()->user();
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the user's password
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully.');
    }

    /**
     * Delete the user's account
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        
        // Valider la confirmation
        $request->validate([
            'confirm_delete' => 'required|accepted',
        ]);

        auth()->logout();
        $user->delete();

        return redirect()->route('threads.index')
            ->with('success', 'Your account has been deleted.');
    }
}