<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add News – LibrarySystem</title>
<link rel="stylesheet" href="{{ asset('css/createnews.css') }}">
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
        <a href="{{ route('news.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to News
        </a>

        <div class="form-container">
            <h2><i class="fas fa-plus-circle"></i> Add New News</h2>

            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                @csrf

                <label for="title"><i class="fas fa-heading"></i> Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Enter news title">

                <label for="content"><i class="fas fa-align-left"></i> Content</label>
                <textarea id="content" name="content" required placeholder="Enter news content">{{ old('content') }}</textarea>
                <small><i class="fas fa-info-circle"></i> Write the full news article content here</small>

                <label for="image"><i class="fas fa-image"></i> News Image</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="image" name="image" accept="image/*" class="file-upload">
                    <label for="image" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i> Choose News Image
                    </label>
                </div>
                <small><i class="fas fa-info-circle"></i> Recommended: 800x400px, max 2MB (optional)</small>

                <!-- Image Preview -->
                <div class="image-preview-container" id="imagePreview">
                    <img id="previewImage" class="image-preview" src="" alt="Image Preview">
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="news-btn add">
                        <i class="fas fa-plus"></i> Add News
                    </button>
                    <a href="{{ route('news.index') }}" class="news-btn cancel">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>

<!-- Footer -->
<footer class="dashboard-footer">
    <div class="copyright">
        &copy; <span id="currentYear"></span> LibrarySystem.
    </div>
</footer>

<script>
    // Set current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();

    // File upload preview
    document.getElementById('image').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const label = document.querySelector('.file-upload-label');
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');

        if (fileName) {
            label.innerHTML = `<i class="fas fa-file-image"></i> ${fileName}`;

            // Show image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            previewContainer.style.display = 'none';
        }
    });

    // Sidebar active links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function () {
            document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Form validation
    const form = document.getElementById('newsForm');
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title');
        const content = document.getElementById('content');

        if (!title.value.trim()) {
            e.preventDefault();
            alert('Please enter a title for the news article.');
            title.focus();
            return false;
        }

        if (!content.value.trim()) {
            e.preventDefault();
            alert('Please enter content for the news article.');
            content.focus();
            return false;
        }

        return true;
    });
</script>
</body>
</html>
