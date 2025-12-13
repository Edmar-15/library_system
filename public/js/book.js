document.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.querySelector('.loginBtn');
    const book = document.querySelector('.book');

    if (loginBtn && book) {
        loginBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Add opening class to trigger animation
            book.classList.add('opening');

            // Get the login route from the href
            const loginUrl = this.getAttribute('href');

            // Wait for animation to complete before redirecting
            setTimeout(function () {
                window.location.href = loginUrl;
            }, 1200); // Match the animation duration
        });
    }

    // Optional: Add animation for register button too
    const registerBtn = document.querySelector('.registerBtn');
    if (registerBtn && book) {
        registerBtn.addEventListener('click', function (e) {
            e.preventDefault();

            book.classList.add('opening');

            const registerUrl = this.getAttribute('href');

            setTimeout(function () {
                window.location.href = registerUrl;
            }, 1200);
        });
    }
});
