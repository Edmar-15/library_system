<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Announcements – LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <header class="dashboard-header">
        <div class="logo-section">
            <i class="fas fa-newspaper logo-icon"></i>
            <span class="logo-text">News & Announcements</span>
        </div>

        <a href="{{ route('show.home') }}" class="book-btn secondary"
            style="margin-left: 15px; display:flex; align-items:center;">
            <i class="fas fa-house" style="margin-right:5px;"></i> Back to Dashboard
        </a>
    </header>

    <div class="dashboard-container">
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Latest News</h1>
                @if (auth()->user()->role === 'librarian')
                    <a href="{{ route('news.create') }}" class="book-btn primary"><i class="fas fa-plus"></i> Add News</a>
                @endif
            </div>

            @if(session('success'))
                <div class="content-card" style="padding:10px; background:#dff0d8; color:#3c763d;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="releases-grid">
                @foreach($newsItems as $news)
                    <div class="release-item">
                        <div class="release-cover">
                            @if($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" class="release-cover-img" alt="news-image">
                            @else
                                <div
                                    style="height:120px; display:flex; align-items:center; justify-content:center; color:#fff;">
                                    <i class="fas fa-newspaper fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="release-info">
                            <div class="release-title">{{ $news->title }}</div>
                            <div class="release-author">{{ Str::limit($news->content, 80) }}</div>
                            <div class="book-actions">
                                <a href="{{ route('news.show', $news) }}" class="book-btn primary"><i
                                        class="fas fa-eye"></i> View</a>
                                @if (auth()->user()->role === 'librarian')
                                    <a href="{{ route('news.edit', $news) }}" class="book-btn secondary"><i
                                            class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('news.destroy', $news) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="book-btn secondary"><i class="fas fa-trash"></i>
                                            Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $newsItems->links() }}
        </div>
    </div>

    <footer class="dashboard-footer">
        <p class="copyright">LibrarySystem &copy; {{ date('Y') }}</p>
    </footer>

</body>

</html>