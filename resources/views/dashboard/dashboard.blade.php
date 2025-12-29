@php
    use App\Models\Menu;

    $headerMenus = Menu::where('is_active', 1)->orderBy('order')->limit(3)->get();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Library-Systtem Dashboard - Track your books, add your books preferred, bookmarks, and explore/navigate other features.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle navigation menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav class="header-nav" id="headerNav">
            @foreach ($headerMenus as $menu)
                @if ($menu->type === 'internal')
                    <a href="{{ url($menu->url) }}" class="header-link">
                        {{ $menu->title }}
                    </a>
                @elseif ($menu->type === 'external')
                    <a href="{{ $menu->url }}" target="_blank" class="header-link">
                        {{ $menu->title }}
                    </a>
                @elseif ($menu->type === 'content')
                    <a href="{{ route('menus.show', $menu->id) }}" class="header-link">
                        {{ $menu->title }}
                    </a>
                @endif
            @endforeach
        </nav>

        @auth
            <div class="user-section">
                <div class="user-info">
                    <a href="{{ route('show.profile') }}" class="user-avatar" title="View Profile">
                        <img src="{{ $profile?->profile_picture ? asset('storage/' . $profile->profile_picture) : asset('images/default.jpg') }}"
                            alt="Profile Picture">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            </div>
        @endauth
    </header>

    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('show.home') }}"
                            class="nav-link {{ request()->routeIs('show.home') ? 'active' : '' }}" title="Dashboard">
                            <i class="fas fa-home nav-icon"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('show.about') }}"
                            class="nav-link {{ request()->routeIs('show.about') ? 'active' : '' }}" title="About">
                            <i class="fas fa-solid fa-eye nav-icon"></i>
                            <span class="nav-text">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('books.index') }}"
                            class="nav-link {{ request()->routeIs('books.index') ? 'active' : '' }}" title="Books">
                            <i class="fas fa-book nav-icon"></i>
                            <span class="nav-text">Books</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bookmarks.index') }}"
                            class="nav-link {{ request()->routeIs('bookmarks.index') ? 'active' : '' }}"
                            title="Bookmarks">
                            <i class="fas fa-bookmark nav-icon"></i>
                            <span class="nav-text">Bookmark</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.index') }}"
                            class="nav-link {{ request()->routeIs('staff.index') ? 'active' : '' }}" title="Staff">
                            <i class="fas fa-address-card nav-icon"></i>
                            <span class="nav-text">Staff</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('news.index') }}"
                            class="nav-link {{ request()->routeIs('news.index') ? 'active' : '' }}" title="News">
                            <i class="fas fa-newspaper nav-icon"></i>
                            <span class="nav-text">News</span>
                        </a>
                    </li>
                    @if (auth()->user()->role === 'librarian')
                        <li class="nav-item">
                            <a href="{{ url('/menus') }}"
                                class="nav-link {{ request()->is('menus') ? 'active' : '' }}" title="Navigation">
                                <i class="fas fa-bars nav-icon"></i>
                                <span class="nav-text">Navigation</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="sidebar-logout">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="sidebar-logout-btn" title="Logout">
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
                @auth
                    <h1 class="page-title">Welcome, {{ Auth::user()->name }}</h1>
                @endauth
                <p class="page-subtitle">
                    Here's what's happening with your library today. Continue your reading journey or explore new
                    releases.
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <h3 class="stat-title">My Booklist</h3>
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $booklist ?? 0 }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <h3 class="stat-title">Books Read</h3>
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $booklistCounts['finished'] ?? 0 }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <h3 class="stat-title">Currently Reading</h3>
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $booklistCounts['reading'] ?? 0 }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <h3 class="stat-title">Bookmarks</h3>
                        <div class="stat-icon">
                            <i class="fas fa-bookmark"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $bookmarks ?? 0 }}</div>
                </div>
            </div>

            <div class="content-grid">
                <!-- Book of the Month -->
                <div class="content-card">
                    <h2><i class="fas fa-crown"></i> New Book Upload</h2>
                    <div class="book-of-month">
                        <div class="book-cover">
                            <img src="{{ $newBook?->cover_picture ? asset('storage/' . $newBook->cover_picture) : asset('images/book-cover.png') }}"
                                alt="{{ $newBook->title ?? 'Book Cover' }}" class="book-cover-img">
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">{{ $newBook->title ?? 'No Book Upload Yet' }}</h3>
                            <p class="book-author">{{ $newBook->author ?? 'Unknown Author' }}</p>
                            <p class="book-description">
                                {{ $newBook->description ?? 'Coming Soon...' }}
                            </p>
                            <div class="book-actions">
                                @if ($newBook?->id)
                                    <button class="book-btn primary add-to-list-btn"
                                        data-book-id="{{ $newBook->id }}">
                                        <i class="fas fa-plus"></i> Add to List
                                    </button>
                                @else
                                    <button class="book-btn primary" disabled>
                                        <i class="fas fa-ban"></i> No book available
                                    </button>
                                @endif

                                @if ($newBook?->id)
                                    <a href="{{ route('books.show', $newBook) }}" class="book-btn secondary">
                                        <i class="fas fa-info-circle"></i> View Details
                                    </a>
                                @else
                                    <span class="book-btn secondary disabled">
                                        No details
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Releases -->
                <div class="content-card">
                    <h2><i class="fas fa-fire"></i> Popular Releases</h2>
                    <div class="releases-grid">
                        @forelse ($popularBooks as $book)
                            <div class="release-item">
                                <div class="release-cover">
                                    <img src="{{ $book->cover_picture ? asset('storage/' . $book->cover_picture) : asset('images/book-cover.png') }}"
                                        alt="{{ $book->title ?? 'Book Cover' }}" class="release-cover-img">
                                </div>
                                <div class="release-info">
                                    <h4 class="release-title">{{ $book->title ?? 'Not Available' }}</h4>
                                    <p class="release-author">{{ $book->author ?? 'Coming Soon...' }}</p>
                                    <div class="release-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($book->rating ?? 0))
                                                <i class="fas fa-star"></i>
                                            @elseif ($i - ($book->rating ?? 0) < 0.5 && $i - ($book->rating ?? 0) > 0)
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="no-releases">No popular releases available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Logout Modal -->
            <div id="logoutModal" class="modal">
                <div class="modal-content">
                    <p class="logout-text">Are you sure you want to logout?</p>

                    <div class="logout-actions">
                        <button id="confirmLogout" class="primary">Yes</button>
                        <button id="cancelLogout" class="secondary">No</button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; {{ date('Y') }} LibrarySystem. All rights reserved.
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const headerNav = document.getElementById('headerNav');

            if (mobileMenuToggle && headerNav) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    headerNav.classList.toggle('active');
                    // Change icon
                    const icon = this.querySelector('i');
                    if (headerNav.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (headerNav.classList.contains('active') &&
                        !headerNav.contains(event.target) &&
                        !mobileMenuToggle.contains(event.target)) {
                        headerNav.classList.remove('active');
                        const icon = mobileMenuToggle.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });

                // Close menu on escape key
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape' && headerNav.classList.contains('active')) {
                        headerNav.classList.remove('active');
                        const icon = mobileMenuToggle.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });

                // Close menu on window resize (if resizing to larger screen)
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 992 && headerNav.classList.contains('active')) {
                        headerNav.classList.remove('active');
                        const icon = mobileMenuToggle.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Add to list functionality
            document.querySelectorAll('.add-to-list-btn').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const bookId = this.dataset.bookId;
                    if (!bookId) return;

                    const button = this;
                    const originalHTML = button.innerHTML;

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
                            button.innerHTML = '<i class="fas fa-check"></i> Added!';
                            button.classList.add('success');

                            // Revert button after 2 seconds
                            setTimeout(() => {
                                button.innerHTML = originalHTML;
                                button.classList.remove('success');
                                button.disabled = false;
                            }, 2000);

                        } else {
                            alert(result.message || 'Book is already in your list.');
                            button.innerHTML = originalHTML;
                            button.disabled = false;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Failed to add book to list. Please try again.');
                        button.innerHTML = originalHTML;
                        button.disabled = false;
                    }
                });
            });

            // Set active sidebar link based on current URL
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Logout confirmation (optional)
            const logoutBtn = document.querySelector('.sidebar-logout-btn');
            const modal = document.getElementById('logoutModal');
            const confirmBtn = document.getElementById('confirmLogout');
            const cancelBtn = document.getElementById('cancelLogout');

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // prevent default action
                    modal.style.display = 'flex'; // show modal
                });
            }

            confirmBtn.addEventListener('click', function() {
                logoutBtn.closest('form').submit(); // ✅ submits POST logout
            });

            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none'; // hide modal
            });

            // Close modal on outside click
            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Helper function to update stats counter (if needed)
        function updateStatsCounter() {}
    </script>
</body>

</html>
