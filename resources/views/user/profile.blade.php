<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
    <h1>Profile Information</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture"><br><br>

        <div id="profile_picture_container">
            @if($user->profile && $user->profile->profile_picture)
                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" width="150">
            @endif
        </div>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" readonly><br><br>

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio">{{ $user->profile->bio ?? '' }}</textarea><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ $user->profile->phone ?? '' }}"><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="{{ $user->profile->address ?? '' }}"><br><br>

        <button type="submit">Update Profile</button>
    </form>

    <script>
    async function loadProfile() {
        try {
            const response = await fetch('/librarysystem/profile/api', {
                method: 'GET',
                credentials: 'same-origin',
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) throw new Error('Failed to fetch profile');

            const profile = await response.json();

            document.getElementById('name').value = profile.name;
            document.getElementById('email').value = profile.email;
            document.getElementById('bio').value = profile.bio;
            document.getElementById('phone').value = profile.phone;
            document.getElementById('address').value = profile.address;

            if (profile.profile_picture) {
                const container = document.getElementById('profile_picture_container');
                container.innerHTML = '';
                const imgTag = document.createElement('img');
                imgTag.src = profile.profile_picture;
                imgTag.width = 150;
                container.appendChild(imgTag);
            }

        } catch (err) {
            console.error(err);
        }
    }

    document.addEventListener('DOMContentLoaded', loadProfile);
    </script>
</body>
</html>