<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/book-form.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="form-header">
        <a href="{{ route('books.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Books
        </a>
        <h1>Add New Book</h1>
    </header>

    <main class="form-main">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="book-form">
            @csrf

            <div class="form-grid">
                <!-- Left Column -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="title"><i class="fas fa-book"></i> Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="author"><i class="fas fa-user"></i> Author *</label>
                        <input type="text" id="author" name="author" value="{{ old('author') }}" required>
                        @error('author')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fas fa-align-left"></i> Description</label>
                        <textarea id="description" name="description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cover_picture"><i class="fas fa-image"></i> Cover Picture</label>
                        <input type="file" id="cover_picture" name="cover_picture" accept="image/*" onchange="previewImage(event)">
                        <div id="imagePreview"></div>
                        @error('cover_picture')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Content File (TXT) -->
                    <div class="mb-6">
                        <label for="content_file" class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-file-alt"></i> Book Content File (TXT)
                        </label>
                        <input type="file" name="content_file" id="content_file" accept=".txt"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Upload the book content as a TXT file (Max: 10MB)</p>
                        
                        <div id="fileInfo" class="mt-2 hidden">
                            <p class="text-sm text-green-600">
                                <i class="fas fa-file-alt"></i> 
                                <span id="fileName"></span> 
                                (<span id="fileSize"></span>)
                            </p>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="rating"><i class="fas fa-star"></i> Rating</label>
                            <input type="number" id="rating" name="rating" step="0.1" min="0" max="5" value="{{ old('rating', 0) }}">
                            @error('rating')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category"><i class="fas fa-tag"></i> Category</label>
                            <select id="category" name="category">
                                <option value="">Select Category</option>
                                <option value="Fiction" {{ old('category') == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                                <option value="Non-Fiction" {{ old('category') == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                                <option value="Science" {{ old('category') == 'Science' ? 'selected' : '' }}>Science</option>
                                <option value="Technology" {{ old('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                <option value="History" {{ old('category') == 'History' ? 'selected' : '' }}>History</option>
                                <option value="Biography" {{ old('category') == 'Biography' ? 'selected' : '' }}>Biography</option>
                                <option value="Romance" {{ old('category') == 'Romance' ? 'selected' : '' }}>Romance</option>
                                <option value="Mystery" {{ old('category') == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                                <option value="Fantasy" {{ old('category') == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                                <option value="Science Fiction" {{ old('category') == 'Science Fiction' ? 'selected' : '' }}>Science Fiction</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="form-column">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="total_copies"><i class="fas fa-copy"></i> Total Copies *</label>
                            <input type="number" id="total_copies" name="total_copies" value="{{ old('total_copies', 1) }}" min="1" required>
                            @error('total_copies')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="available_copies"><i class="fas fa-check-circle"></i> Available Copies *</label>
                            <input type="number" id="available_copies" name="available_copies" value="{{ old('available_copies', 1) }}" min="0" required>
                            @error('available_copies')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="isbn"><i class="fas fa-barcode"></i> ISBN</label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}">
                        @error('isbn')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="publisher"><i class="fas fa-building"></i> Publisher</label>
                        <input type="text" id="publisher" name="publisher" value="{{ old('publisher') }}">
                        @error('publisher')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="publication_year"><i class="fas fa-calendar"></i> Year</label>
                            <input type="number" id="publication_year" name="publication_year" value="{{ old('publication_year') }}" min="1000" max="{{ date('Y') }}">
                            @error('publication_year')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pages"><i class="fas fa-file-alt"></i> Pages</label>
                            <input type="number" id="pages" name="pages" value="{{ old('pages') }}" min="1">
                            @error('pages')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="language"><i class="fas fa-language"></i> Language</label>
                        <input type="text" id="language" name="language" value="{{ old('language', 'English') }}">
                        @error('language')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Add Book
                </button>
                <a href="{{ route('books.index') }}" class="btn-cancel">
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
    </script>
</body>
</html>
