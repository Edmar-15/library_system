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
            <div class="container" id="books-container">
                @include('books.partials.grid', ['books' => $books])
            </div>
        </section>
    </main>

    <footer class="books-footer">
        <p>&copy; {{ date('Y') }} LibrarySystem. All rights reserved.</p>
    </footer>

    <script>
        const form = document.querySelector('.search-form');
        const container = document.getElementById('books-container');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const params = new URLSearchParams(new FormData(form));

            fetch(`{{ route('books.index') }}?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                container.innerHTML = html;
                bindAddToListButtons();
            });
        });

        function bindAddToListButtons() {
            document.querySelectorAll('.add-to-list-btn').forEach(btn => {
                btn.onclick = async () => {
                    btn.disabled = true;
                    btn.innerHTML = 'Adding...';

                    const res = await fetch('/booklists', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            book_id: btn.dataset.bookId,
                            status: 'want_to_read'
                        })
                    });

                    const data = await res.json();

                    if (res.ok && data.success) {
                        btn.innerHTML = 'Added';
                    } else {
                        btn.disabled = false;
                        btn.innerHTML = 'Add to List';
                        alert(data.message || 'Failed');
                    }
                };
            });
        }

        bindAddToListButtons();
    </script>
</body>
</html>