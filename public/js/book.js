
document.addEventListener("DOMContentLoaded", () => {
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Get all page containers
    const homePage = document.getElementById("homePage");
    const loginPage = document.getElementById("loginPage");
    const registerPage = document.getElementById("registerPage");
    const forgotPage = document.getElementById("forgotPage");
    
    // Get the book element
    const book = document.querySelector("#homePage .book");
    
    // Get header title
    const headerTitle = document.getElementById("headerTitle");
    
    // Track current page
    let currentPage = "home";
    
    // OPEN BOOK ON LOAD
    book.style.transform = "rotateY(90deg)";
    setTimeout(() => {
        book.style.transform = "rotateY(0deg)";
    }, 300);
    
    // FUNCTION: Navigate between pages
    function navigateToPage(pageName) {
        // Hide all pages
        homePage.classList.remove("active");
        loginPage.classList.remove("active");
        registerPage.classList.remove("active");
        forgotPage.classList.remove("active");
        
        // Show the target page
        if (pageName === "home") {
            homePage.classList.add("active");
            headerTitle.textContent = "LibrarySystem";
        } else if (pageName === "login") {
            loginPage.classList.add("active");
            headerTitle.textContent = "Library System";
        } else if (pageName === "register") {
            registerPage.classList.add("active");
            headerTitle.textContent = "Library System";
        } else if (pageName === "forgot") {
            forgotPage.classList.add("active");
            headerTitle.textContent = "Library System";
        }
        
        currentPage = pageName;
    }
    
    // FUNCTION: Open book animation then navigate
    function openBookAndGo(pageName) {
        const homeBook = document.querySelector("#homePage .book");
        homeBook.classList.add("book-opening");
        
        setTimeout(() => {
            navigateToPage(pageName);
            homeBook.classList.remove("book-opening");
        }, 800);
    }
    
    // FUNCTION: Clear error messages
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('input').forEach(el => el.classList.remove('error'));
    }
    
    // FUNCTION: Display error
    function showError(fieldId, message) {
        const errorElement = document.getElementById(fieldId + 'Error');
        const inputElement = document.getElementById(fieldId);
        if (errorElement) {
            errorElement.textContent = message;
        }
        if (inputElement) {
            inputElement.classList.add('error');
        }
    }
    
    // HOME PAGE BUTTONS
    const registerBtn = document.getElementById("registerBtn");
    registerBtn.addEventListener("click", () => {
        clearErrors();
        openBookAndGo("register");
    });
    
    const loginBtn = document.getElementById("loginBtn");
    loginBtn.addEventListener("click", () => {
        clearErrors();
        openBookAndGo("login");
    });
    
    // HEADER TITLE - Back to home
    headerTitle.addEventListener("click", () => {
        if (currentPage !== "home") {
            clearErrors();
            navigateToPage("home");
        }
    });
    
    // LOGIN FORM
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearErrors();
        
        const email = document.getElementById("loginEmail").value;
        const password = document.getElementById("loginPassword").value;
        const submitBtn = loginForm.querySelector('.btn-submit');
        
        // Disable button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Logging in...';
        
        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                // Redirect to dashboard or home
                window.location.href = data.redirect || '/dashboard';
            } else {
                // Show errors
                if (data.errors) {
                    for (const [field, messages] of Object.entries(data.errors)) {
                        showError('login' + field.charAt(0).toUpperCase() + field.slice(1), messages[0]);
                    }
                } else {
                    showError('loginEmail', data.message || 'Login failed');
                }
            }
        } catch (error) {
            showError('loginEmail', 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Login';
        }
    });
    
    // REGISTER FORM
    const registerForm = document.getElementById("registerForm");
    registerForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearErrors();
        
        const email = document.getElementById("registerEmail").value;
        const password = document.getElementById("registerPassword").value;
        const passwordConfirmation = document.getElementById("confirmPassword").value;
        const submitBtn = registerForm.querySelector('.btn-submit');
        
        // Client-side validation
        if (password !== passwordConfirmation) {
            showError('confirmPassword', 'Passwords do not match!');
            return;
        }
        
        // Disable button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Registering...';
        
        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    email, 
                    password, 
                    password_confirmation: passwordConfirmation 
                })
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                // Redirect to dashboard or home
                window.location.href = data.redirect || '/dashboard';
            } else {
                // Show errors
                if (data.errors) {
                    for (const [field, messages] of Object.entries(data.errors)) {
                        let errorField = 'register' + field.charAt(0).toUpperCase() + field.slice(1);
                        if (field === 'password_confirmation') {
                            errorField = 'confirmPassword';
                        }
                        showError(errorField, messages[0]);
                    }
                } else {
                    showError('registerEmail', data.message || 'Registration failed');
                }
            }
        } catch (error) {
            showError('registerEmail', 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'confirm';
        }
    });
    
    // FORGOT PASSWORD FORM
    const forgotForm = document.getElementById("forgotForm");
    forgotForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearErrors();
        
        const email = document.getElementById("forgotEmail").value;
        const submitBtn = forgotForm.querySelector('.btn-submit');
        
        // Disable button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
        
        try {
            const response = await fetch('/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email })
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                alert(data.message || 'Password reset link sent to your email!');
                navigateToPage('login');
            } else {
                if (data.errors) {
                    for (const [field, messages] of Object.entries(data.errors)) {
                        showError('forgotEmail', messages[0]);
                    }
                } else {
                    showError('forgotEmail', data.message || 'Failed to send reset link');
                }
            }
        } catch (error) {
            showError('forgotEmail', 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Confirm';
        }
    });
    
    // FORGOT PASSWORD LINK
    const forgotPasswordLink = document.getElementById("forgotPasswordLink");
    forgotPasswordLink.addEventListener("click", (e) => {
        e.preventDefault();
        clearErrors();
        navigateToPage("forgot");
    });
    
    // TO REGISTER LINK
    const toRegisterLink = document.getElementById("toRegisterLink");
    toRegisterLink.addEventListener("click", (e) => {
        e.preventDefault();
        clearErrors();
        navigateToPage("register");
    });
    
    // TRY ANOTHER WAY LINK
    const tryAnotherWay = document.getElementById("tryAnotherWay");
    tryAnotherWay.addEventListener("click", (e) => {
        e.preventDefault();
        clearErrors();
        navigateToPage("login");
    });
    
    // CLEAR EMAIL BUTTON (Forgot Password)
    const clearBtn = document.querySelector(".clear-btn");
    clearBtn.addEventListener("click", () => {
        document.getElementById("forgotEmail").value = "";
    });
});