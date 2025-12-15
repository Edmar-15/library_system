<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Books - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/book-index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="books-header">
        <div class="header-content">
            <div class="logo-section">
                <a href="{{ route('show.home') }}" class="logo-link">
                    <i class="fas fa-book-open"></i>
                    <span>LibrarySystem</span>
                </a>
            </div>
            <nav class="header-nav">
                <a href="{{ route('show.home') }}" class="home-btn">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="{{ route('books.index') }}" class="active"><i class="fas fa-book"></i> Books</a>
                <a href="{{ route('booklists.index') }}"><i class="fas fa-list"></i> My Booklists</a>
                
            </nav>
        </div>
    </header>

    <main class="books-main">
        <!-- Search and Filter Section -->
        <section class="search-section">
            <div class="container">
                <h1 class="page-title">Browse Books</h1>
                <p class="page-subtitle">Explore our collection of books</p>

                @if (auth()->user()->role === 'librarian')
                    <div style="margin-bottom: 20px;">
                        <a href="{{ route('books.create') }}" class="btn btn-primary" style="display: inline-block; padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
                            <i class="fas fa-plus"></i> Add New Book
                        </a>
                    </div> 
                @endif

                <form action="{{ route('books.index') }}" method="GET" class="search-form">
                    <div class="search-bar">
                        <input type="text" name="search" placeholder="Search by title, author, ISBN..." 
                               value="{{ request('search') }}" class="search-input">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>

                    <div class="filters">
                        <select name="category" class="filter-select">
                            <option value="">All Categories</option>
                            <option value="Fiction" {{ request('category') == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                            <option value="Non-Fiction" {{ request('category') == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                            <option value="Science" {{ request('category') == 'Science' ? 'selected' : '' }}>Science</option>
                            <option value="Technology" {{ request('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="History" {{ request('category') == 'History' ? 'selected' : '' }}>History</option>
                            <option value="Biography" {{ request('category') == 'Biography' ? 'selected' : '' }}>Biography</option>
                            <option value="Romance" {{ request('category') == 'Romance' ? 'selected' : '' }}>Romance</option>
                            <option value="Mystery" {{ request('category') == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                            <option value="Fantasy" {{ request('category') == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                            <option value="Science Fiction" {{ request('category') == 'Science Fiction' ? 'selected' : '' }}>Science Fiction</option>
                        </select>

                        <select name="available" class="filter-select">
                            <option value="">All Books</option>
                            <option value="1" {{ request('available') == '1' ? 'selected' : '' }}>Available Only</option>
                        </select>

                        <select name="sort" class="filter-select">
                            <option value="latest">Latest Added</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        </select>

                        <button type="submit" class="filter-btn">Apply Filters</button>
                        <a href="{{ route('books.index') }}" class="clear-btn">Clear</a>
                    </div>
                </form>
            </div>
        </section>

        <!-- Books Grid -->
        <section class="books-section">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if($books->isEmpty())
                    <div class="no-books">
                        <i class="fas fa-book-open"></i>
                        <h2>No books found</h2>
                        <p>Try adjusting your search or filters</p>
                    </div>
                @else
                    <div class="books-grid">
                        @foreach($books as $book)
                            <div class="book-card">
                                <div class="book-cover">
                                    @if($book->cover_picture)
                                        <img src="{{ asset('storage/' . $book->cover_picture) }}" alt="{{ $book->title }}">
                                    @else
                                        <div class="book-placeholder">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    @endif
                                    
                                    <div class="book-status {{ $book->isAvailable() ? 'available' : 'unavailable' }}">
                                        {{ $book->isAvailable() ? 'Available' : 'Unavailable' }}
                                    </div>
                                </div>

                                <div class="book-info">
                                    <h3 class="book-title">{{ Str::limit($book->title, 50) }}</h3>
                                    <p class="book-author">by {{ $book->author }}</p>
                                    
                                    <div class="book-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($book->rating))
                                                <i class="fas fa-star"></i>
                                            @elseif($i - 0.5 <= $book->rating)
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span class="rating-value">{{ number_format($book->rating, 2) }}</span>
                                    </div>

                                    <div class="book-meta">
                                        @if($book->category)
                                            <span class="book-category">{{ $book->category }}</span>
                                        @endif
                                        <span class="book-copies">{{ $book->available_copies }}/{{ $book->total_copies }} copies</span>
                                    </div>

                                    <div class="book-actions">
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-primary">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        @auth
                                            <button class="btn btn-secondary add-to-list-btn" data-book-id="{{ $book->id }}">
                                                <i class="fas fa-plus"></i> Add to List
                                            </button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    
                @endif
            </div>
        </section>
    </main>

    <footer class="books-footer">
        <p>&copy; {{ date('Y') }} LibrarySystem. All rights reserved.</p>
    </footer>

    <script>
        // Add to booklist functionality
        document.querySelectorAll('.add-to-list-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                const bookId = this.dataset.bookId;
                const button = this;
                
                // Disable button to prevent double clicks
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
                
                try {
                    const response = await fetch('/booklists', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ 
                            book_id: bookId,
                            status: 'want_to_read'
                        })
                    });

                    const result = await response.json();
                    
                    if (response.ok && result.success) {
                        alert('✓ Book added to your list!');
                        button.innerHTML = '<i class="fas fa-check"></i> Added';
                        button.classList.add('btn-success');
                    } else {
                        alert(result.message || 'Failed to add book. It may already be in your list.');
                        button.disabled = false;
                        button.innerHTML = '<i class="fas fa-plus"></i> Add to List';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-plus"></i> Add to List';
                }
            });
        });
    </script>
</body>
</html>