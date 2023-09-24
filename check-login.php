<?php
session_start();

// Check if the user is logged in based on your authentication logic
$isLoggedIn = isset($_SESSION['user_id']);

// Return the result as a JSON object
echo json_encode(['isLoggedIn' => $isLoggedIn]);
?>
