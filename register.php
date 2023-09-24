<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('db_connection.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input (client-side validation can be added here too)

    // Hash the password before storing it in the database
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $query = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $password_hash);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header('Location: login.html');
        exit();
    } else {
        // Registration failed, display the error
        echo "Registration failed. Error: " . mysqli_error($conn);
    }

    $stmt->close();
    $conn->close();
}
?>
