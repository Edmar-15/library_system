<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} – LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/show-news.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>
        <a href="{{ route('news.index') }}" class="book-btn secondary" style="margin-top:20px;"><i
                class="fas fa-arrow-left"></i> Back to News</a>
    </header>

    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item"><a href="{{ route('news.index') }}" class="nav-link active"><i
                                class="fas fa-newspaper nav-icon"></i><span class="nav-text">News</span></a></li>
                </ul>
            </div>
        </div>

        <main class="main-content">


            <div class="content-card">

                <div class="book-of-month">
                    @if ($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" alt="news-image" class="news-image">
                    @endif
                    <div class="page-header">
                        <h1 class="page-title">{{ $news->title }}</h1>
                        <p class="page-subtitle">Published on {{ $news->created_at->format('F j, Y') }}</p>
                        <div class="book-info">
                            <p class="book-description">{!! nl2br(e($news->content)) !!}</p>
                        </div>
                    </div>

                </div>
            </div>


    </div>

    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; {{ date('Y') }} LibrarySystem. All rights reserved.
        </div>
    </footer>

</body>

</html>
