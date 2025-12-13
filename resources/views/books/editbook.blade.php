<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/editbook.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="form-header">
        <a href="{{ route('books.show', $book) }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Book Details
        </a>
        <h1>Edit Book</h1>
    </header>

    <main class="form-main">
        <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="book-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- Left Column -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="title"><i class="fas fa-book"></i> Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="author"><i class="fas fa-user"></i> Author *</label>
                        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
                        @error('author')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fas fa-align-left"></i> Description</label>
                        <textarea id="description" name="description" rows="5">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cover_picture"><i class="fas fa-image"></i> Cover Picture</label>
                        @if($book->cover_picture)
                            <div class="current-image">
                                <img src="{{ asset('storage/' . $book->cover_picture) }}" alt="Current cover" style="max-width: 200px; margin-bottom: 10px; border-radius: 8px;">
                            </div>
                        @endif
                        <input type="file" id="cover_picture" name="cover_picture" accept="image/*" onchange="previewImage(event)">
                        <div id="imagePreview"></div>
                        @error('cover_picture')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content_file"><i class="fas fa-file-alt"></i> Book Content File (TXT)</label>
                        @if($book->hasContentFile())
                            <div class="current-file" style="margin-bottom: 10px; padding: 10px; background: #e8f5e9; border-radius: 5px;">
                                <i class="fas fa-check-circle" style="color: green;"></i> 
                                <span>Content file uploaded</span>
                                <a href="{{ route('books.download', $book) }}" style="margin-left: 10px; color: #1976d2;">
                                    <i class="fas fa-download"></i> Download Current
                                </a>
                            </div>
                        @else
                            <div style="margin-bottom: 10px; padding: 10px; background: #ffebee; border-radius: 5px;">
                                <i class="fas fa-times-circle" style="color: red;"></i> 
                                <span>No content file uploaded</span>
                            </div>
                        @endif
                        <input type="file" id="content_file" name="content_file" accept=".txt" onchange="previewContentFile(event)">
                        <small style="display: block; margin-top: 5px; color: #666;">Upload TXT file (Max: 10MB). Leave empty to keep current file.</small>
                        <div id="contentFilePreview"></div>
                        @error('content_file')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="rating"><i class="fas fa-star"></i> Rating</label>
                            <input type="number" id="rating" name="rating" step="0.1" min="0" max="5" value="{{ old('rating', $book->rating) }}">
                            @error('rating')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category"><i class="fas fa-tag"></i> Category</label>
                            <select id="category" name="category">
                                <option value="">Select Category</option>
                                <option value="Fiction" {{ old('category', $book->category) == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                                <option value="Non-Fiction" {{ old('category', $book->category) == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                                <option value="Science" {{ old('category', $book->category) == 'Science' ? 'selected' : '' }}>Science</option>
                                <option value="Technology" {{ old('category', $book->category) == 'Technology' ? 'selected' : '' }}>Technology</option>
                                <option value="History" {{ old('category', $book->category) == 'History' ? 'selected' : '' }}>History</option>
                                <option value="Biography" {{ old('category', $book->category) == 'Biography' ? 'selected' : '' }}>Biography</option>
                                <option value="Romance" {{ old('category', $book->category) == 'Romance' ? 'selected' : '' }}>Romance</option>
                                <option value="Mystery" {{ old('category', $book->category) == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                                <option value="Fantasy" {{ old('category', $book->category) == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                                <option value="Science Fiction" {{ old('category', $book->category) == 'Science Fiction' ? 'selected' : '' }}>Science Fiction</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="form-column">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="total_copies"><i class="fas fa-copy"></i> Total Copies *</label>
                            <input type="number" id="total_copies" name="total_copies" value="{{ old('total_copies', $book->total_copies) }}" min="1" required>
                            @error('total_copies')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="available_copies"><i class="fas fa-check-circle"></i> Available Copies *</label>
                            <input type="number" id="available_copies" name="available_copies" value="{{ old('available_copies', $book->available_copies) }}" min="0" required>
                            @error('available_copies')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="isbn"><i class="fas fa-barcode"></i> ISBN</label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
                        @error('isbn')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="publisher"><i class="fas fa-building"></i> Publisher</label>
                        <input type="text" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}">
                        @error('publisher')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="publication_year"><i class="fas fa-calendar"></i> Year</label>
                            <input type="number" id="publication_year" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}" min="1000" max="{{ date('Y') }}">
                            @error('publication_year')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pages"><i class="fas fa-file-alt"></i> Pages</label>
                            <input type="number" id="pages" name="pages" value="{{ old('pages', $book->pages) }}" min="1">
                            @error('pages')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="language"><i class="fas fa-language"></i> Language</label>
                        <input type="text" id="language" name="language" value="{{ old('language', $book->language) }}">
                        @error('language')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update Book
                </button>
                <a href="{{ route('books.show', $book) }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </main>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; margin-top: 10px; border-radius: 8px;">`;
                }
                reader.readAsDataURL(file);
            }
        }

        function previewContentFile(event) {
            const preview = document.getElementById('contentFilePreview');
            const file = event.target.files[0];
            
            if (file) {
                const fileSizeKB = (file.size / 1024).toFixed(2);
                preview.innerHTML = `
                    <div style="margin-top: 10px; padding: 10px; background: #e3f2fd; border-radius: 5px;">
                        <i class="fas fa-file-alt" style="color: #1976d2;"></i> 
                        <strong>${file.name}</strong> (${fileSizeKB} KB)
                    </div>
                `;
            } else {
                preview.innerHTML = '';
            }
        }
    </script>
</body>
</html>