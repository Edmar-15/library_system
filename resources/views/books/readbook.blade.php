<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read: {{ $book->title }} - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/book-reader.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="reader-header">
        <div class="header-content">
            <a href="{{ route('books.show', $book) }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Book Details
            </a>
            <h1 class="book-title">{{ $book->title }}</h1>
            <a href="{{ route('books.download', $book) }}" class="download-btn">
                <i class="fas fa-download"></i> Download
            </a>
        </div>
    </header>

    <main class="reader-main">
        <div class="reader-container">
            <div class="book-info-bar">
                <span class="author">by {{ $book->author }}</span>
                @if($book->pages)
                    <span class="pages">{{ $book->pages }} pages</span>
                @endif
                @if($book->language)
                    <span class="language">{{ $book->language }}</span>
                @endif
            </div>

            <div class="book-content">
                <pre>{{ $content }}</pre>
            </div>
        </div>
    </main>

    <footer class="reader-footer">
        <p>&copy; {{ date('Y') }} LibrarySystem. All rights reserved.</p>
    </footer>
</body>
</html>