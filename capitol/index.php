<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home</title>
    <link rel="stylesheet" href="css/index.css"> <!-- Link to external CSS file -->
</head>
<body>

<!-- Wrap the content inside .container to apply margins -->
<div class="container">

    <header>
        <button class="logout-btn" onclick="window.location.href='register.php'">Logout</button>
        <h1>Company Name</h1>
        <img src="img/logo.png" alt="Company Logo">
    </header>

    <nav>
        <a href="admin.php">Admin</a>
        <a href="division.php">Division</a>
        <a href="separation.php">Separation</a>
    </nav>

    <div class="content">
        <h2>Mission & Vision</h2>
        <p>Our mission is to deliver excellent services and create value for our stakeholders.</p>
        <p>Our vision is to be the leading company in our industry, empowering people and driving innovation.</p>

        <div class="search-bar">
            <input type="text" placeholder="Search for something...">
            <button>Search</button>
        </div>

        <div class="services">
            <h2>Our Services</h2>
            <img src="img/orgchart.jpg" width="50%" alt="Organization Chart">
            <p>We offer a wide range of services to meet the needs of our customers.</p>
        </div>
    </div>

    <footer>
        <p>Contact us:</p>
        <p>Email: contact@company.com</p>
        <p>Facebook: <a href="https://facebook.com/company" target="_blank">facebook.com/company</a></p>
        <p>Phone: +123 456 7890</p>
    </footer>

</div>

</body>
</html>
