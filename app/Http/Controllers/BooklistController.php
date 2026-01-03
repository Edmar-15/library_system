<?php

namespace App\Http\Controllers;

use App\Models\Booklist;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooklistController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()
            ->booklists()
            ->with('book');

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        $booklists = $query->latest()->paginate(12);

        return view('books.userbooklist', compact('booklists'));
    }

    /**
     * Add a book to user's booklist
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'book_id' => 'required|exists:books,id',
                'status' => 'nullable|in:want_to_read,reading,finished',
            ]);

            $validated['user_id'] = Auth::id();
            $validated['status'] = $validated['status'] ?? 'want_to_read';

            // Check if book already exists in user's list
            $existing = Booklist::where('user_id', Auth::id())
                                ->where('book_id', $validated['book_id'])
                                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'This book is already in your list'
                ], 422);
            }

            $booklist = Booklist::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Book added to your list!',
                'data' => $booklist->load('book')
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update booklist entry
     */
    public function update(Request $request, Booklist $booklist)
    {
        // Check if user owns this booklist entry
        if ($booklist->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'nullable|in:want_to_read,reading,finished',
            'notes' => 'nullable|string|max:1000',
            'user_rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $booklist->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Updated successfully',
                'data' => $booklist->load('book')
            ]);
        }

        return redirect()->back()->with('success', 'Updated successfully!');
    }

    /**
     * Remove book from booklist
     */
    public function destroy(Booklist $booklist)
    {
        // Check if user owns this booklist entry
        if ($booklist->user_id !== Auth::id()) {
            abort(403);
        }

        $booklist->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Book removed from your list'
            ]);
        }

        return redirect()->back()->with('success', 'Book removed from your list');
    }

    /**
     * Get user's booklist stats
     */
    public function stats()
    {
        $userId = Auth::id();

        $stats = [
            'total' => Booklist::where('user_id', $userId)->count(),
            'want_to_read' => Booklist::where('user_id', $userId)->byStatus('want_to_read')->count(),
            'reading' => Booklist::where('user_id', $userId)->byStatus('reading')->count(),
            'finished' => Booklist::where('user_id', $userId)->byStatus('finished')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}