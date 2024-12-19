<?php
session_start();
include 'db.php'; // Include database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Query to check if the user is an admin
$sql = "SELECT role FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['role'] !== 'admin') { // Check if the user is not an admin
        header("Location: index.php");
        exit;
    }
} else {
    echo "Error: Unable to verify user.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, Admin</h1>
        <p>You have access to the admin panel.</p>
    </div>
</body>
</html>
