<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        $users = User::all();

        return view('admin.admins', compact('users'));
    }

    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);

        $user->update(['isAdmin' => !$user->isAdmin]);

        return redirect()->back();
    }
}
