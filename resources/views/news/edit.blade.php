<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit News – LibrarySystem</title>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .container { max-width:600px; margin:2rem auto; }
    .form-card { padding:1rem; }
    label { font-weight:bold; margin-top:0.5rem; display:block; }
    input, textarea { width:100%; padding:0.5rem; margin-top:0.3rem; border-radius:5px; border:1px solid #ccc; }
    textarea { resize: vertical; min-height:100px; }
    .book-btn { margin-top:1rem; }
</style>
</head>
<body>

<header class="dashboard-header">
    <div class="logo-section">
        <i class="fas fa-newspaper logo-icon"></i>
        <span class="logo-text">Edit News</span>
    </div>
</header>

<div class="dashboard-container">
    <div class="main-content">
        <div class="container">
            <div class="form-card content-card">
                <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required>

                    <label>Content</label>
                    <textarea name="content" required>{{ old('content', $news->content) }}</textarea>

                    <label>Current Image</label>
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" width="120" alt="news-image">
                    @else
                        <p>No image uploaded</p>
                    @endif

                    <label>Change Image</label>
                    <input type="file" name="image" accept="image/*">

                    <button type="submit" class="book-btn primary"><i class="fas fa-edit"></i> Update News</button>
                    <a href="{{ route('news.index') }}" class="book-btn secondary"><i class="fas fa-arrow-left"></i> Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>