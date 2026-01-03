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
                        <img src="{{ asset('storage/' . $book->cover_picture) }}">
                    @else
                        <div class="book-placeholder">
                            <i class="fas fa-book"></i>
                        </div>
                    @endif
                </div>

                <div class="book-info">
                    <h3>{{ Str::limit($book->title, 50) }}</h3>
                    <span class="book-category">{{ $book->category }}</span>
                    <p>by {{ $book->author }}</p>

                    <div class="book-actions">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-primary">
                            View Details
                        </a>
                        @auth
                            <button class="btn btn-secondary add-to-list-btn" data-book-id="{{ $book->id }}">
                                Add to List
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif