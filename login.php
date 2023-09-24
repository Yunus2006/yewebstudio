<?php
session_start();
require_once('db_connection.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user data from the database
    $query = "SELECT id, username, password_hash FROM users WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $username, $password_hash);
    $stmt->fetch();

    if (password_verify($password, $password_hash)) {
        // Login successful, set session variables and redirect to user dashboard
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        header('Location: index.html');
        exit();
    } else {
        // Login failed
        echo "Login failed. Please check your credentials.";
    }

    $stmt->close();
    $conn->close();
}
?>
