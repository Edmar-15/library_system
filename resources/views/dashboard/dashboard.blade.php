@php
use App\Models\Menu;

$headerMenus = Menu::where('is_active', 1)
    ->orderBy('order')
    ->limit(3)
    ->get();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
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
    </div>

    <nav class="header-nav">
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
          <a href="{{ route('show.profile') }}" class="user-avatar">
            <img src="{{ $profile?->profile_picture
      ? asset('storage/' . $profile->profile_picture)
      : asset('images/default.jpg') }}" alt="profile-pic">
            <i class="user-name">{{ Auth::user()->name }}</i>
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
            <a href="{{ route('show.home') }}" class="nav-link active" title="Dashboard">
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
            <a href="{{ route('bookmarks.index') }}" class="nav-link" title="Bookmarks">
              <i class="fas fa-bookmark nav-icon"></i>
              <span class="nav-text">Bookmark</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('staff.index') }}" class="nav-link" title="Edit">
              <i class="fas fa-address-card nav-icon"></i>
              <span class="nav-text">Staff</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('news.index') }}" class="nav-link" title="News">
              <i class="fas fa-newspaper nav-icon"></i>
              <span class="nav-text">News</span>
            </a>
          </li>
          @if (auth()->user()->role === 'librarian')
              <li class="nav-item">
  <a href="{{ url('/menus') }}" class="nav-link" title="Navigation">
    <i class="fas fa-bars nav-icon"></i>
    <span class="nav-text">Navigation</span>
  </a>
</li>
          @endif
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
              <img src="{{ $newBook?->cover_picture
  ? asset('storage/' . $newBook->cover_picture)
  : asset('images/book-cover.png') }}" alt="book_cover" class="book-cover">
            </div>
            <div class="book-info">
              <h3 class="book-title">{{ $newBook->title ?? 'No Book Upload Yet' }}</h3>
              <p class="book-author">{{ $newBook->author ?? 'Unknown Author' }}</p>
              <p class="book-description">
                {{ $newBook->description ?? 'Coming Soon...' }}
              </p>
              <div class="book-actions">
                @if($newBook?->id)
                  <button class="book-btn primary add-to-list-btn" data-book-id="{{ $newBook->id }}">
                    <i class="fas fa-plus"></i> Add to List
                  </button>
                @else
                  <button class="book-btn primary" disabled>
                    <i class="fas fa-ban"></i> No book available
                  </button>
                @endif

                @if($newBook?->id)
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
            @foreach ($popularBooks as $book)
                      <div class="release-item">
                        <div class="release-cover">
                          <img src="{{ $book->cover_picture
              ? asset('storage/' . $book->cover_picture)
              : asset('images/book-cover.png') }}" alt="book_cover" class="release-cover-img">
                        </div>

                        <div class="release-info">
                          <h4 class="release-title">{{ $book->title ?? 'Not Available' }}</h4>
                          <p class="release-author">{{ $book->author ?? 'Coming Soon...' }}</p>

                          <div class="release-rating">
                            @for ($i = 1; $i <= 5; $i++)
                              @if ($i <= floor($book->rating))
                                <i class="fas fa-star"></i>
                              @elseif ($i - $book->rating >= 0.5)
                                <i class="fas fa-star-half-alt"></i>
                              @else
                                <i class="far fa-star"></i>
                              @endif
                            @endfor
                          </div>
                        </div>
                      </div>
            @endforeach
          </div>
        </div>

      </div>
  </div>
  </main>
  </div>

  <!-- Footer -->
  <footer class="dashboard-footer">
    <div class="copyright">
      &copy; {{ date('Y') }} LibrarySystem.
    </div>
    </div>
  </footer>

  <script>
    // Logout button
    document.querySelector('.sidebar-logout-btn')?.addEventListener('click', function (e) {
      // Optional custom logic
    });

    // Sidebar active links
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function () {
        document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
        this.classList.add('active');
      });
    });

    document.querySelectorAll('.add-to-list-btn').forEach(btn => {
      btn.addEventListener('click', async function () {
        const bookId = this.dataset.bookId;
        if (!bookId) return;
        const button = this;

        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

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
            button.innerHTML = '<i class="fas fa-check"></i>';
            button.classList.add('success');
          } else {
            alert(result.message || 'Already in your list.');
            resetBtn(button);
          }
        } catch {
          alert('Request failed.');
          resetBtn(button);
        }
      });
    });

    function resetBtn(btn) {
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-plus"></i> Add to List';
    }
  </script>
</body>

</html>