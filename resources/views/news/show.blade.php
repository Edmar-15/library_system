<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $news->title }} – LibrarySystem</title>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
    <div class="sidebar">
        <div class="sidebar-content">
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('news.index') }}" class="nav-link active"><i class="fas fa-newspaper nav-icon"></i><span class="nav-text">News</span></a></li>
            </ul>
        </div>
    </div>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">{{ $news->title }}</h1>
            <p class="page-subtitle">Published on {{ $news->created_at->format('F j, Y') }}</p>
        </div>

        <div class="content-card">
            <div class="book-of-month" style="flex-direction: column; gap: 20px;">
                @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" alt="news-image" style="width:100%; max-width:600px; border-radius:10px; object-fit:cover; box-shadow:var(--shadow);">
                @endif
                <div class="book-info">
                    <p style="color:var(--text-light); line-height:1.6; font-size:16px;">{!! nl2br(e($news->content)) !!}</p>
                </div>
            </div>
        </div>

        <a href="{{ route('news.index') }}" class="book-btn secondary" style="margin-top:20px;"><i class="fas fa-arrow-left"></i> Back to News</a>
    </main>
</div>

<footer class="dashboard-footer">
    <div class="copyright">
        &copy; {{ date('Y') }} LibrarySystem. All rights reserved.
    </div>
</footer>

</body>
</html>