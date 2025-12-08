document.addEventListener("DOMContentLoaded", () => {

    const emailField = document.querySelector("input[type='email']");
    const passwordField = document.querySelector("input[type='password']");
    const confirmField = document.querySelectorAll("input[type='password']")[1];

    // Helper: create both error & success messages
    function addValidationMessages(input, errorMsg, successMsg) {
        const error = document.createElement("div");
        error.classList.add("error-message");
        error.textContent = errorMsg;

        const success = document.createElement("div");
        success.classList.add("success-message");
        success.textContent = successMsg;

        input.insertAdjacentElement("afterend", success);
        input.insertAdjacentElement("afterend", error);

        return { error, success };
    }

    const emailMsg = addValidationMessages(
        emailField,
        "Enter a valid email.",
        "Email looks good!"
    );

    const passMsg = addValidationMessages(
        passwordField,
        "Password must be at least 8 characters.",
        "Password is strong!"
    );

    const confirmMsg = addValidationMessages(
        confirmField,
        "Passwords do not match.",
        "Passwords match!"
    );


    function validateEmail() {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!pattern.test(emailField.value)) {
            emailField.classList.add("error");
            emailField.classList.remove("success");
            emailMsg.error.classList.add("show");
            emailMsg.success.classList.remove("show");
        } else {
            emailField.classList.remove("error");
            emailField.classList.add("success");
            emailMsg.error.classList.remove("show");
            emailMsg.success.classList.add("show");
        }
    }

    function validatePassword() {
        if (passwordField.value.length < 8) {
            passwordField.classList.add("error");
            passwordField.classList.remove("success");
            passMsg.error.classList.add("show");
            passMsg.success.classList.remove("show");
        } else {
            passwordField.classList.remove("error");
            passwordField.classList.add("success");
            passMsg.error.classList.remove("show");
            passMsg.success.classList.add("show");
        }

        validateConfirm();
    }

    function validateConfirm() {
        if (confirmField.value !== passwordField.value || confirmField.value === "") {
            confirmField.classList.add("error");
            confirmField.classList.remove("success");
            confirmMsg.error.classList.add("show");
            confirmMsg.success.classList.remove("show");
        } else {
            confirmField.classList.remove("error");
            confirmField.classList.add("success");
            confirmMsg.error.classList.remove("show");
            confirmMsg.success.classList.add("show");
        }
    }

    emailField.addEventListener("input", validateEmail);
    passwordField.addEventListener("input", validatePassword);
    confirmField.addEventListener("input", validateConfirm);
});