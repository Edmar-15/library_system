<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
    <h1>Profile Information</h1>

    <h2>Edit Profile</h2>

    <form id="profileForm" action="/librarysystem/profile/{{ auth()->user()->profile->id }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture"><br><br>
        <div id="profile_picture_container"></div>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" readonly><br><br>

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"></textarea><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br><br>


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
            const imgTag = document.createElement('img');
            imgTag.src = '/storage/' + profile.profile_picture;
            imgTag.width = 150;
            document.getElementById('profile_picture_container').appendChild(imgTag);
        }

    } catch (err) {
        console.error(err);
    }
}


document.addEventListener('DOMContentLoaded', loadProfile);
</script>

</body>
</html>
