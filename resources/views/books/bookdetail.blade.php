<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/book-details.css') }}">
</head>
<body>
    <header class="book-header">
        <div class="header-content">
            <a href="{{ route('books.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Books
            </a>
            <a href="{{ route('show.home') }}" class="home-btn">
                <i class="fas fa-home"></i> Home
            </a>
        </div>
    </header>

    <main class="book-details-main">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="book-details-grid">
                <!-- Book Cover -->
                <div class="book-cover-section">
                    @if($book->cover_picture)
                        <img src="{{ asset('storage/' . $book->cover_picture) }}" alt="{{ $book->title }}" class="book-cover-large">
                    @else
                        <div class="book-placeholder-large">
                            <i class="fas fa-book"></i>
                        </div>
                    @endif

                    <div class="availability-badge {{ $book->isAvailable() ? 'available' : 'unavailable' }}">
                        @if($book->isAvailable())
                            <i class="fas fa-check-circle"></i> Available
                        @else
                            <i class="fas fa-times-circle"></i> Unavailable
                        @endif
                    </div>

                    <div class="book-actions-large">
                        @auth
                            <button class="btn btn-primary btn-large add-to-list-btn" data-book-id="{{ $book->id }}">
                                <i class="fas fa-plus"></i> Add to My List
                            </button>
                            
                            @if($book->isAvailable())
                                <button class="btn btn-secondary btn-large">
                                    <i class="fas fa-bookmark"></i> Reserve Book
                                </button>
                            @endif

                            {{-- Book Content Actions --}}
                            @if($book->hasContentFile())
                                <a href="{{ route('books.readbook', $book) }}" class="btn btn-info btn-large">
                                    <i class="fas fa-book-open"></i> Read Online
                                </a>
                                <a href="{{ route('books.download', $book) }}" class="btn btn-success btn-large">
                                    <i class="fas fa-download"></i> Download Book
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Book Information -->
                <div class="book-info-section">
                    <h1 class="book-title-large">{{ $book->title }}</h1>
                    <h2 class="book-author-large">by {{ $book->author }}</h2>

                    <div class="book-rating-large">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($book->rating))
                                    <i class="fas fa-star"></i>
                                @elseif($i - 0.5 <= $book->rating)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="rating-number">{{ number_format($book->rating, 1) }}/5.0</span>
                    </div>

                    @if($book->description)
                        <div class="book-description">
                            <h3>Description</h3>
                            <p>{{ $book->description }}</p>
                        </div>
                    @endif

                    <div class="book-metadata">
                        <h3>Book Details</h3>
                        <ul class="metadata-list">
                            @if($book->isbn)
                                <li>
                                    <span class="meta-label">ISBN:</span>
                                    <span class="meta-value">{{ $book->isbn }}</span>
                                </li>
                            @endif
                            
                            @if($book->publisher)
                                <li>
                                    <span class="meta-label">Publisher:</span>
                                    <span class="meta-value">{{ $book->publisher }}</span>
                                </li>
                            @endif
                            
                            @if($book->publication_year)
                                <li>
                                    <span class="meta-label">Publication Year:</span>
                                    <span class="meta-value">{{ $book->publication_year }}</span>
                                </li>
                            @endif
                            
                            @if($book->category)
                                <li>
                                    <span class="meta-label">Category:</span>
                                    <span class="meta-value">{{ $book->category }}</span>
                                </li>
                            @endif
                            
                            @if($book->language)
                                <li>
                                    <span class="meta-label">Language:</span>
                                    <span class="meta-value">{{ $book->language }}</span>
                                </li>
                            @endif
                            
                            @if($book->pages)
                                <li>
                                    <span class="meta-label">Pages:</span>
                                    <span class="meta-value">{{ $book->pages }} pages</span>
                                </li>
                            @endif
                            
                            <li>
                                <span class="meta-label">Total Copies:</span>
                                <span class="meta-value">{{ $book->total_copies }}</span>
                            </li>
                            
                            <li>
                                <span class="meta-label">Available Copies:</span>
                                <span class="meta-value {{ $book->available_copies > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $book->available_copies }}
                                </span>
                            </li>

                            {{-- Content File Status --}}
                            <li>
                                <span class="meta-label">Book Content:</span>
                                <span class="meta-value">
                                    @if($book->hasContentFile())
                                        <i class="fas fa-check-circle" style="color: green;"></i> Available
                                    @else
                                        <i class="fas fa-times-circle" style="color: red;"></i> Not Available
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'librarian') <!-- Admin check -->
                            <div class="admin-actions">
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Book
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete Book
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </main>

    <footer class="book-footer">
        <p>&copy; {{ date('Y') }} LibrarySystem. All rights reserved.</p>
    </footer>

    <script>
        document.querySelector('.add-to-list-btn')?.addEventListener('click', async function() {
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
                    button.innerHTML = '<i class="fas fa-check"></i> Added to List';
                    button.classList.add('btn-success');
                } else {
                    alert(result.message || 'Failed to add book. It may already be in your list.');
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-plus"></i> Add to My List';
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-plus"></i> Add to My List';
            }
        });
    </script>
</body>
</html>