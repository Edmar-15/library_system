<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booklist;
use App\Models\Bookmark;
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

        $newBook = Book::latest()->first();

        $booklist = $user->booklists()->count();

        $booklistCounts = [
            'want_to_read' => Booklist::where('user_id', $user->id)
                ->where('status', 'want_to_read')
                ->count(),

            'reading' => Booklist::where('user_id', $user->id)
                ->where('status', 'reading')
                ->count(),

            'finished' => Booklist::where('user_id', $user->id)
                ->where('status', 'finished')
                ->count(),
        ];

        $bookmarks = Bookmark::where('user_id', $user->id)->count();

        $popularBooks = Book::orderBy('rating', 'desc')->limit(4)->get();

        return view('dashboard.dashboard', compact('user', 'profile', 'newBook', 'booklist', 'booklistCounts', 'bookmarks', 'popularBooks'));
    }

    public function getProfile(){
        $user = User::find('profile'); 
        return response()->json($user);
    }
}
