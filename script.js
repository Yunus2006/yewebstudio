document.addEventListener('DOMContentLoaded', function() {
    var userDropdown = document.getElementById('user-dropdown');
    var userIcon = userDropdown.querySelector('.navbar__links');

    // Check if the user is logged in based on some authentication logic
    function checkLoginStatus() {
        // Replace this with your actual authentication or session management logic
        var isLoggedIn = localStorage.getItem('isLoggedIn'); // Example: Check if a flag for login status is set
        return !!isLoggedIn; // Convert to boolean, assuming a valid flag indicates a logged-in state
    }

    // Function to toggle the dropdown
    function toggleDropdown() {
        userDropdown.classList.toggle('active');
    }

    // Check the user's login status and add appropriate event listeners
    if (checkLoginStatus()) {
        // If the user is logged in, toggle the dropdown when the user icon is clicked
        userIcon.addEventListener('click', function(e) {
            e.preventDefault();
            toggleDropdown();
        });
    } else {
        // If the user is not logged in, redirect to login.html when the user icon is clicked
        userIcon.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'login.html';
        });

        // Disable the hover effect when not logged in
        userIcon.style.pointerEvents = 'none';
    }
});
