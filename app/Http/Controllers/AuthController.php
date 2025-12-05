<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\FuncCall;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function showLogin () {
        return view('auth.login');
    }

    public function register(Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed'
    ]);

    $validated['password'] = Hash::make($validated['password']);

    $user = User::create($validated);

    Auth::login($user); // log in the user

    // Return the profile view directly
    return view('profile', ['user' => $user]);   
 }
        // Get user profile
   
    public function login (Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('show.home');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Sorry, incorrect credentials',
        ]);
    }
    
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.welcome');
    }
}