<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booklists - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/booklists.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="booklists-header">
        <div class="header-content">
            <div class="logo-section">
                <a href="{{ route('show.home') }}" class="logo-link">
                    <i class="fas fa-book-open"></i>
                    <span>LibrarySystem</span>
                </a>
            </div>
            <nav class="header-nav">
                <a href="{{ route('show.home') }}"><i class="fas fa-home"></i> Home</a>
                <a href="{{ route('books.index') }}"><i class="fas fa-book"></i> Books</a>
                <a href="{{ route('booklists.index') }}" class="active"><i class="fas fa-list"></i> My Booklists</a>
            </nav>
        </div>
    </header>

    <main class="booklists-main">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">My Booklists</h1>
                <p class="page-subtitle">Manage your reading collection</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon want-to-read">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Want to Read</h3>
                        <p class="stat-number">{{ $booklists->where('status', 'want_to_read')->count() }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon reading">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Currently Reading</h3>
                        <p class="stat-number">{{ $booklists->where('status', 'reading')->count() }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon finished">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Finished</h3>
                        <p class="stat-number">{{ $booklists->where('status', 'finished')->count() }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Books</h3>
                        <p class="stat-number">{{ $booklists->total() }}</p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-section">
                <form action="{{ route('booklists.index') }}" method="GET" class="filter-form">
                    <select name="status" class="filter-select">
                        <option value="">All Statuses</option>
                        <option value="want_to_read" {{ request('status') == 'want_to_read' ? 'selected' : '' }}>Want to Read</option>
                        <option value="reading" {{ request('status') == 'reading' ? 'selected' : '' }}>Currently Reading</option>
                        <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finished</option>
                    </select>
                    <button type="submit" class="filter-btn">Filter</button>
                    <a href="{{ route('booklists.index') }}" class="clear-btn">Clear</a>
                </form>

                <a href="{{ route('books.index') }}" class="add-books-btn">
                    <i class="fas fa-plus"></i> Add More Books
                </a>
            </div>

            <!-- Booklist Grid -->
            @if($booklists->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h2>Your booklist is empty</h2>
                    <p>Start adding books to track your reading journey!</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary">
                        <i class="fas fa-search"></i> Browse Books
                    </a>
                </div>
            @else
                <div class="booklists-grid">
                    @foreach($booklists as $item)
                        <div class="booklist-card">
                            <div class="book-cover-small">
                                @if($item->book->cover_picture)
                                    <img src="{{ asset('storage/' . $item->book->cover_picture) }}" alt="{{ $item->book->title }}">
                                @else
                                    <div class="book-placeholder-small">
                                        <i class="fas fa-book"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="booklist-info">
                                <h3 class="book-title">{{ Str::limit($item->book->title, 40) }}</h3>
                                <p class="book-author">by {{ $item->book->author }}</p>

                                <form action="{{ route('booklists.update', $item) }}" method="POST" class="status-form">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="want_to_read" {{ $item->status == 'want_to_read' ? 'selected' : '' }}>Want to Read</option>
                                        <option value="reading" {{ $item->status == 'reading' ? 'selected' : '' }}>Currently Reading</option>
                                        <option value="finished" {{ $item->status == 'finished' ? 'selected' : '' }}>Finished</option>
                                    </select>
                                </form>

                                @if($item->notes)
                                    <p class="book-notes">{{ Str::limit($item->notes, 60) }}</p>
                                @endif

                                <div class="booklist-actions">
                                    <!-- Delete button -->
                                    <form action="{{ route('booklists.destroy', $item) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon" data-tooltip="Delete" onclick="return confirm('Remove this book from your list?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <!-- Notes button -->
                                    <button class="btn btn-sm btn-secondary btn-icon edit-notes-btn" data-tooltip="Edit Notes" data-id="{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- View button -->
                                    <a href="{{ route('books.show', $item->book) }}" class="btn btn-sm btn-primary btn-icon" data-tooltip="View Book">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $booklists->links() }}
                </div>
            @endif
        </div>
    </main>

    <footer class="booklists-footer">
        <p>&copy; {{ date('Y') }} LibrarySystem. All rights reserved.</p>
    </footer>

    <!-- Notes Modal -->
    <div id="notesModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Edit Notes</h2>
            <form id="notesForm">
                @csrf
                @method('PUT')
                <textarea name="notes" id="notesTextarea" rows="5" placeholder="Add your notes about this book..."></textarea>
                <div class="modal-actions">
                    <button type="submit" class="btn btn-primary">Save Notes</button>
                    <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('notesModal');
        const closeBtn = document.querySelector('.close-modal');
        const cancelBtn = document.querySelector('.cancel-btn');
        let currentItemId = null;

        document.querySelectorAll('.edit-notes-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                currentItemId = this.dataset.id;
                modal.style.display = 'flex';
            });
        });

        closeBtn.onclick = () => modal.style.display = 'none';
        cancelBtn.onclick = () => modal.style.display = 'none';

        document.getElementById('notesForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const notes = document.getElementById('notesTextarea').value;

            try {
                const response = await fetch(`/booklists/${currentItemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ notes })
                });

                const result = await response.json();

                if (result.success) {
                    alert('Notes saved!');
                    modal.style.display = 'none';
                    location.reload();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to save notes');
            }
        });
    </script>
</body>
</html>
