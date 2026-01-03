<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Book;

class RatingController extends Controller
{
    public function rate(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ],
            [
                'rating' => $request->rating
            ]
        );

        return response()->json([
            'average' => $book->averageRating(),
            'count' => $book->ratings()->count()
        ]);
    }
}
