<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Bookmarks - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/bookmarks.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>
    </header>

    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('show.home') }}" class="nav-link" title="Dashboard">
                            <i class="fas fa-home nav-icon"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('show.about') }}" class="nav-link" title="About">
                            <i class="fas fa-solid fa-eye nav-icon"></i>
                            <span class="nav-text">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('books.index') }}" class="nav-link" title="Books">
                            <i class="fas fa-book nav-icon"></i>
                            <span class="nav-text">Books</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bookmarks.index') }}" class="nav-link active" title="Bookmarks">
                            <i class="fas fa-bookmark nav-icon"></i>
                            <span class="nav-text">Bookmarks</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('booklists.index') }}" class="nav-link" title="Booklists">
                            <i class="fas fa-list nav-icon"></i>
                            <span class="nav-text">My List</span>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-logout">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="sidebar-logout-btn">
                            <i class="fas fa-sign-out-alt sidebar-logout-icon"></i>
                            <span class="sidebar-logout-text">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <main class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Your Bookmarks</h1>
                <p class="page-subtitle">
                    Continue reading from where you left off. Your saved reading positions are listed below.
                </p>
            </div>

            <!-- Bookmarks Content -->
            <div class="content-card">
                @if ($bookmarks->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-bookmark fa-3x" style="color: var(--text-light); margin-bottom: 20px;"></i>
                        <h3 style="color: var(--text-light); margin-bottom: 10px;">No bookmarks yet</h3>
                        <p style="color: var(--text-light); margin-bottom: 25px;">
                            Start reading a book and bookmark your progress to continue later.
                        </p>
                        <a href="{{ route('books.index') }}" class="book-btn primary">
                            <i class="fas fa-book-open"></i> Browse Books
                        </a>
                    </div>
                @else
                    <div class="bookmarks-grid">
                        @foreach ($bookmarks as $bookmark)
                            <div class="bookmark-card">
                                <div class="bookmark-cover">
                                    <img src="{{ asset('storage/' . $bookmark->book->cover_picture) }}" alt="{{ $bookmark->book->title }}">
                                </div>
                                <div class="bookmark-info">
                                    <h3 class="bookmark-title">{{ $bookmark->book->title }}</h3>
                                    <p class="bookmark-author">{{ $bookmark->book->author }}</p>

                                    <div class="bookmark-progress">
                                        <div class="progress-label">
                                            <span>Last Read:</span>
                                            <strong>Page {{ $bookmark->last_page }}</strong>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="progress-fill"
                                                 style="width: {{ min(($bookmark->last_page / 300) * 100, 100) }}%"></div>
                                        </div>
                                    </div>

                                    <div class="bookmark-actions">
                                        <a href="{{ route('books.readbook', ['book' => $bookmark->book->id, 'page' => $bookmark->last_page]) }}"
                                           class="book-btn primary">
                                            <i class="fas fa-play"></i> Continue Reading
                                        </a>
                                        <a href="{{ route('books.show', $bookmark->book) }}"
                                           class="book-btn secondary">
                                            <i class="fas fa-info-circle"></i> View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; {{ date('Y') }} LibrarySystem.
        </div>
    </footer>
    <script>
        // Sidebar active links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function () {
                document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
