<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Edit About Page</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('show.about') }}">Back to About Page</a>
            <a href="{{ route('show.home') }}">Home</a>
        </nav>
    </header>

    <main>
        <h1>Edit About Page</h1>

        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="form-group">
                <label for="title">Page Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $about->title) }}" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $about->description) }}</textarea>
            </div>

            <!-- Mission (Editable by Librarian) -->
            <div class="form-group">
                <label for="mission">Mission:</label>
                <textarea id="mission" name="mission" rows="5">{{ old('mission', $about->mission) }}</textarea>
            </div>

            <!-- Vision (Editable by Librarian) -->
            <div class="form-group">
                <label for="vision">Vision:</label>
                <textarea id="vision" name="vision" rows="5">{{ old('vision', $about->vision) }}</textarea>
            </div>

            <!-- System Features -->
            <div class="form-group">
                <label for="features">System Features:</label>
                <textarea id="features" name="features" rows="6">{{ old('features', $about->features) }}</textarea>
                <small>Separate features with commas</small>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Logo/Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
                
                @if($about->image)
                <div class="current-image">
                    <p>Current image:</p>
                    <img src="{{ asset('storage/' . $about->image) }}" alt="Current logo" width="200">
                </div>
                @endif
            </div>

            <!-- Contact Email -->
            <div class="form-group">
                <label for="contact_email">Contact Email:</label>
                <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $about->contact_email) }}">
            </div>

            <!-- Contact Phone -->
            <div class="form-group">
                <label for="contact_phone">Contact Phone:</label>
                <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $about->contact_phone) }}">
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit">Update About Page</button>
                <a href="{{ route('show.about') }}">Cancel</a>
            </div>
        </form>

        <hr>

        <h2>Team Members</h2>
        <p><em>Note: To update team members, please contact the system administrator.</em></p>
        
        @if($about->developer_name && is_array($about->developer_name))
        <div class="team-list">
            @foreach($about->developer_name as $index => $member)
            <div class="team-member">
                <p><strong>{{ $index + 1 }}. {{ $member['name'] }}</strong></p>
                <p>Role: {{ $member['role'] }}</p>
                <p>Email: {{ $member['email'] }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </main>
</body>
</html>