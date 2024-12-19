<?php
$servername = "localhost"; // Typically localhost if using XAMPP
$username = "root";        // Default username in XAMPP for MySQL
$password = "";            // Default password in XAMPP for MySQL
$dbname = "website_db";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
