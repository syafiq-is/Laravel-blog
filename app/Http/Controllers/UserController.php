<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        // User::all() or User::latest()
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|string',
        ]);

        // User Create Attempt
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect("login")
                ->with(['success' => 'User created successfully']);
        } catch (\Exception $e) {

            return redirect()->back()
                ->withErrors(['error' => 'Failed to create user: ']);
        }
    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        if ($user->id !== auth()->id()) {
            abort(403);
        }

        $validatedData = $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'profile_img' => 'image'
        ]);

        if (request()->has('profile_img')) {
            // Store to storage in storage/profile
            $imgPath = request()->file('profile_img')->store('profile', 'public');
            $validatedData['profile_img'] = $imgPath;

            // Prevent default profile image deletion
            if ($user->profile_img !== 'profile/profile_default.png') {
                // Delete previous image
                Storage::disk('public')->delete($user->profile_img);
            }
        }

        $user->update($validatedData);

        return redirect(route('profile', ['userId' => auth()->user()->id]));
    }

    public function deleteWithPosts($userId, Request $request)
    {
        $user = User::findOrFail($userId);

        if ($user->id !== auth()->id()) {
            abort(403);
        }

        $user->posts()->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect("/");
    }
}
