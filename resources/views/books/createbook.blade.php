@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-bold mb-6">Add New Book</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Author -->
                <div class="mb-4">
                    <label for="author" class="block text-gray-700 font-semibold mb-2">Author <span class="text-red-500">*</span></label>
                    <input type="text" name="author" id="author" value="{{ old('author') }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- ISBN -->
                <div class="mb-4">
                    <label for="isbn" class="block text-gray-700 font-semibold mb-2">ISBN</label>
                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Publisher and Publication Year -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="publisher" class="block text-gray-700 font-semibold mb-2">Publisher</label>
                        <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="publication_year" class="block text-gray-700 font-semibold mb-2">Publication Year</label>
                        <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year') }}" 
                               min="1000" max="{{ date('Y') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Category and Language -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
                        <input type="text" name="category" id="category" value="{{ old('category') }}" 
                               placeholder="e.g., Fiction, Science, History"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="language" class="block text-gray-700 font-semibold mb-2">Language</label>
                        <input type="text" name="language" id="language" value="{{ old('language', 'English') }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Pages and Rating -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="pages" class="block text-gray-700 font-semibold mb-2">Pages</label>
                        <input type="number" name="pages" id="pages" value="{{ old('pages') }}" min="1"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="rating" class="block text-gray-700 font-semibold mb-2">Rating (0-5)</label>
                        <input type="number" name="rating" id="rating" value="{{ old('rating') }}" 
                               min="0" max="5" step="0.1"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Total Copies and Available Copies -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="total_copies" class="block text-gray-700 font-semibold mb-2">Total Copies <span class="text-red-500">*</span></label>
                        <input type="number" name="total_copies" id="total_copies" value="{{ old('total_copies', 1) }}" 
                               min="1" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="available_copies" class="block text-gray-700 font-semibold mb-2">Available Copies <span class="text-red-500">*</span></label>
                        <input type="number" name="available_copies" id="available_copies" value="{{ old('available_copies', 1) }}" 
                               min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>

                <!-- Cover Picture -->
                <div class="mb-4">
                    <label for="cover_picture" class="block text-gray-700 font-semibold mb-2">Cover Picture</label>
                    <input type="file" name="cover_picture" id="cover_picture" accept="image/*"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                    
                    <div id="imagePreview" class="mt-3 hidden">
                        <img id="preview" src="" alt="Cover preview" class="max-w-xs rounded-lg shadow-md">
                    </div>
                </div>

                <!-- Content File (TXT) -->
                <div class="mb-6">
                    <label for="content_file" class="block text-gray-700 font-semibold mb-2">Book Content File (TXT)</label>
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

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('books.index') }}" 
                       class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        Add Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('cover_picture').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').classList.add('hidden');
    }
});

// Content file info display
document.getElementById('content_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('fileSize').textContent = (file.size / 1024).toFixed(2) + ' KB';
        document.getElementById('fileInfo').classList.remove('hidden');
    } else {
        document.getElementById('fileInfo').classList.add('hidden');
    }
});

// Auto-update available copies when total copies changes
document.getElementById('total_copies').addEventListener('input', function() {
    const availableCopies = document.getElementById('available_copies');
    if (availableCopies.value === '' || parseInt(availableCopies.value) > parseInt(this.value)) {
        availableCopies.value = this.value;
    }
});
</script>
@endsection