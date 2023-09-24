<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to a login page or any other appropriate page
    header("Location: index.html");
    exit;
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.html");
    exit;
}
?>
