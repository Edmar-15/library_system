// function selectRole(role) {
//     // Ensure role is always treated as a string
//     role = String(role);

//     // Build the query string
//     const qs = new URLSearchParams({ role });

//     // Use a proper Laravel URL (DON'T link to .blade.php files)
//     const targetUrl = '/reset-password?' + qs.toString();

//     // Try to get the animated card container
//     const container = document.getElementById('card');

//     if (container) {
//         // Trigger the book-open animation
//         container.classList.add('open');

//         // Wait for the CSS animation to complete (1s)
//         setTimeout(() => {
//             window.location.href = targetUrl;
//         }, 1000); // match your CSS transition time
//     } else {
//         // Fallback: redirect immediately
//         window.location.href = targetUrl;
//     }
// }
