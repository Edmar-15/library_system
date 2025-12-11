<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user(); // get the user
        $profile = $user->profile; // may be null

        // Ensure profile exists
        if (!$profile) {
            $profile = Profile::create([
                'user_id' => $user->id,
                'profile_picture' => 'profile_pictures/default.jpg',
                'bio' => '',
                'phone' => '',
                'address' => '',
            ]);
        }

        return view('dashboard.dashboard', compact('user', 'profile'));
    }

    public function getProfile(){
        $user = User::find('profile'); 
        return response()->json($user);
    }
}
