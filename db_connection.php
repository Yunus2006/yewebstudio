<?php
$host = 'localhost';
$username = 'admin1';
$password = 'Yunus061203'; // Make sure it matches the password you set
$dbname = 'user_auth';

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
