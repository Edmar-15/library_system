<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('dashboard.dashboard');
    }
    public function getProfile(){
        $user = User::find('profile'); 
        return response()->json($user);
    }
}
