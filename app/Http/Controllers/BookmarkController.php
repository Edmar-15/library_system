<?php

namespace App\Http\Controllers;
use App\Models\Bookmark;
use App\Models\Book;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
     public function save(Request $request, Book $book)
    {
        $request->validate([
            'page' => 'required|integer|min:1'
        ]);

        Bookmark::updateOrCreate(
            ['user_id' => auth()->id(), 'book_id' => $book->id],
            ['last_page' => $request->page]
        );

        return response()->json(['status' => 'saved']);
    }
        public function index()
    {
        $bookmarks = Bookmark::with('book')
            ->where('user_id', auth()->id())
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }
}
