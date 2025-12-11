<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $user_id = Auth::id();

        $user = Profile::where('user_id', $user_id)->first();

        return view('dashboard.dashboard', compact('user'));
    }
    public function getProfile(){
        $user = User::find('profile'); 
        return response()->json($user);
    }
}
