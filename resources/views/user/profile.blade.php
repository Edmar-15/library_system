<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Profile</title>
</head>
<body>
    <div class="form-container">
        <h2>Profile Form</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            
            <!-- Profile Picture -->
            <div class="form-group">
                <label for="profile-picture">Profile Picture</label>
                <input type="file" id="profile-picture" name="profile-picture" accept="image/*">
                <img id="image-preview" src="#" alt="Profile Picture Preview" style="display: none;">
            </div>
            
            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" readonly>
            </div>
            
            <!-- Address -->
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>
            
            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required placeholder="XXX-XXX-XXXX">
            </div>
            
            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit">Save Profile</button>
            </div>
        </form>

        <a href="{{ route('show.home') }}">Back</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        fetchProfile();
    });
    function fetchProfile() {
        fetch('/api/users') // Make sure this API returns user + profile data
            .then(res => res.json())
            .then(data => {
                const nameInput = document.getElementById('name');
                const emailInput = document.getElementById('email');
                const addressInput = document.getElementById('address');
                const phoneInput = document.getElementById('phone');
                const imgPreview = document.getElementById('image-preview');

                // Fill form fields
                nameInput.value = data.name || '';
                emailInput.value = data.email || '';
                addressInput.value = data.profile?.address || 'Address not found';
                phoneInput.value = data.profile?.phone || 'Phone not found';

                // Display profile picture
                if (data.profile?.profile_picture) {
                    imgPreview.src = `/storage/${data.profile.profile_picture}`;
                    imgPreview.style.display = 'block';
                }
            })
            .catch(err => console.error('Error fetching profile:', err));
    }
    </script>
</body>
</html>