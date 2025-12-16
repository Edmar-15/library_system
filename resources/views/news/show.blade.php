<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} – LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/showNew.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('news.index') }}" class="nav-link active" title="News">
                            <i class="fas fa-newspaper nav-icon"></i>
                            <span class="nav-text">News</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="main-content">
            <!-- Back button moved here, positioned at top left -->
            <a href="{{ route('news.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to News
            </a>

            <div class="content-card">
                <div class="book-of-month">
                    @if ($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}"
                             alt="{{ $news->title }}"
                             class="news-image">
                    @endif

                    <div class="page-header">
                        <h1 class="page-title">{{ $news->title }}</h1>
                        <p class="page-subtitle">
                            <i class="far fa-calendar-alt"></i>
                            Published on {{ $news->created_at->format('F j, Y') }}
                        </p>

                        <div class="book-info">
                            <div class="book-description">
                                {!! nl2br(e($news->content)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; <span id="currentYear"></span> LibrarySystem.
        </div>
    </footer>

    <script>
        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
</body>
</html>
