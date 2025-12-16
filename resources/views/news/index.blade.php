<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Announcements – LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="logo-section">
            <i class="fas fa-newspaper logo-icon"></i>
            <span class="logo-text">News & Announcements</span>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('show.home') }}" class="nav-link" title="Home">
                            <i class="fas fa-home nav-icon"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('news.index') }}" class="nav-link active" title="News">
                            <i class="fas fa-newspaper nav-icon"></i>
                            <span class="nav-text">News</span>
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

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Latest News</h1>
                @if (auth()->user()->role === 'librarian')
                    <a href="{{ route('news.create') }}" class="book-btn primary">
                        <i class="fas fa-plus"></i> Add News
                    </a>
                @endif
            </div>

            @if(session('success'))
                <div class="content-card success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="releases-grid">
                @foreach($newsItems as $news)
                    <div class="release-item">
                        <div class="release-cover">
                            @if($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" class="release-cover-img" alt="{{ $news->title }}">
                            @else
                                <div style="height:100%; display:flex; align-items:center; justify-content:center; color:#fff;">
                                    <i class="fas fa-newspaper fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="release-info">
                            <div class="release-title">{{ $news->title }}</div>
                            <div class="release-author">{{ Str::limit($news->content, 80) }}</div>
                            <div class="book-actions">
                                <a href="{{ route('news.show', $news) }}" class="book-btn primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                @if (auth()->user()->role === 'librarian')
                                    <a href="{{ route('news.edit', $news) }}" class="book-btn secondary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('news.destroy', $news) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="book-btn secondary">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $newsItems->links() }}
        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <p class="copyright">LibrarySystem &copy; {{ date('Y') }}</p>
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
