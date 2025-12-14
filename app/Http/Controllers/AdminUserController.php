<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'users' => User::select('id', 'name', 'email', 'role')->get(),
            'account' => auth()->user()
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $current = auth()->user();

        // Block editing other super admins
        if ($user->role === 'super_admin' && $current->id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'role' => 'required|in:student,librarian,super_admin'
        ]);

        if ($request->role === 'super_admin' && $current->id !== $user->id) {
            abort(403);
        }

        $user->update([
            'role' => $request->role
        ]);

        return back();
    }
}
