<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of books
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Search functionality
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->byCategory($request->category);
        }

        // Filter by availability
        if ($request->has('available') && $request->available == '1') {
            $query->available();
        }

        // Sort by rating
        if ($request->has('sort') && $request->sort == 'rating') {
            $query->orderBy('rating', 'desc');
        } else {
            $query->latest();
        }

        $books = $query->paginate(12);

        return view('books.bookindex', compact('books'));
    }

    /**
     * Show the form for creating a new book
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_file' => 'nullable|file|mimes:txt|max:10240', // Max 10MB for txt files
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'isbn' => 'nullable|string|unique:books,isbn',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'category' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:50',
            'pages' => 'nullable|integer|min:1',
        ]);

        // Handle cover picture upload
        if ($request->hasFile('cover_picture')) {
            $validated['cover_picture'] = $request->file('cover_picture')
                ->store('uploads/books/covers', 'public');
        }

        // Handle content file upload (TXT only)
        if ($request->hasFile('content_file')) {
            $validated['content_file'] = $request->file('content_file')
                ->store('uploads/books/contents', 'public');
        }

        // Set status based on available copies
        $validated['status'] = $validated['available_copies'] > 0 ? 'available' : 'unavailable';

        $book = Book::create($validated);

        return redirect()->route('books.show', $book)
            ->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified book
     */
    public function show(Book $book)
    {
        return view('books.bookdetail', compact('book'));
    }

    /**
     * Show the form for editing the specified book
     */
    public function edit(Book $book)
    {
        return view('books.editbook', compact('book'));
    }

    /**
     * Update the specified book
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_file' => 'nullable|file|mimes:txt|max:10240', // Max 10MB for txt files
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'isbn' => ['nullable', 'string', Rule::unique('books')->ignore($book->id)],
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'category' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:50',
            'pages' => 'nullable|integer|min:1',
        ]);

        // Handle cover picture upload
        if ($request->hasFile('cover_picture')) {
            // Delete old cover picture
            if ($book->cover_picture && Storage::disk('public')->exists($book->cover_picture)) {
                Storage::disk('public')->delete($book->cover_picture);
            }
            $validated['cover_picture'] = $request->file('cover_picture')
                ->store('uploads/books/covers', 'public');
        }

        // Handle content file upload
        if ($request->hasFile('content_file')) {
            // Delete old content file
            if ($book->content_file && Storage::disk('public')->exists($book->content_file)) {
                Storage::disk('public')->delete($book->content_file);
            }
            $validated['content_file'] = $request->file('content_file')
                ->store('uploads/books/contents', 'public');
        }

        // Update status based on available copies
        $validated['status'] = $validated['available_copies'] > 0 ? 'available' : 'unavailable';

        $book->update($validated);

        return redirect()->route('books.show', $book)
            ->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified book
     */
    public function destroy(Book $book)
    {
        // Delete cover picture if exists
        if ($book->cover_picture && Storage::disk('public')->exists($book->cover_picture)) {
            Storage::disk('public')->delete($book->cover_picture);
        }

        // Delete content file if exists
        if ($book->content_file && Storage::disk('public')->exists($book->content_file)) {
            Storage::disk('public')->delete($book->content_file);
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully!');
    }

    /**
     * Read the content of a book (display or download)
     */
    public function readContent(Book $book, Request $request)
    {
        if (!$book->hasContentFile()) {
            abort(404, 'Content file not found');
        }

        $content = $book->readContent();

        $charsPerPage = 1500;
        $pages = str_split($content, $charsPerPage);
        $totalPages = count($pages);

        $page = (int) $request->query('page', 1);
        if ($page < 1 || $page > $totalPages) {
            $page = 1;
        }

        $pageContent = $pages[$page - 1];

        return view('books.readbook', [
            'book'       => $book,
            'content'    => $pageContent,
            'page'       => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * Download the book content file
     */
    public function downloadContent(Book $book)
    {
        if (!$book->hasContentFile()) {
            abort(404, 'Content file not found');
        }

        $filePath = storage_path('app/public/' . $book->content_file);
        $fileName = $book->title . '.txt';

        return response()->download($filePath, $fileName);
    }

    /**
     * API: Get all books with filtering
     */
    public function apiIndex(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $query->search($request->search);
        }

        if ($request->has('category') && $request->category != '') {
            $query->byCategory($request->category);
        }

        if ($request->has('available') && $request->available == '1') {
            $query->available();
        }

        $books = $query->latest()->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    /**
     * API: Get single book
     */
    public function apiShow(Book $book)
    {
        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    /**
     * API: Update book rating
     */
    public function updateRating(Request $request, Book $book)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:0|max:5'
        ]);

        $book->update(['rating' => $validated['rating']]);

        return response()->json([
            'success' => true,
            'message' => 'Rating updated successfully',
            'data' => $book
        ]);
    }
}