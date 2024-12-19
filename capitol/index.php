<?php
session_start();
include 'db.php'; // Include the database connection

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Fetch the user role from the database
$username = $_SESSION['username'];
$sql = "SELECT role FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $role = $user['role']; // Store the user role
} else {
    echo "Error: Unable to retrieve user information.";
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

   <div class="bg">
   <header>
        <button class="logout-btn" onclick="window.location.href='register.php'">Logout</button>
        <h1>Welcome, <?= htmlspecialchars($username); ?></h1>
        <img src="img/logo1.png" alt="Company Logo">
    </header>
   </div> 

   <nav>
       <?php if ($role === 'admin'): ?>
           <a href="admin.php">Admin</a> <!-- Link to the protected admin page -->
       <?php endif; ?>
       <a href="division.php">Division</a>
       <a href="separation.php">Separation</a>
   </nav>

   <div class="content">
       <h2>Mission & Vision</h2>
       <table style="width: 100%; border-collapse: collapse; background-color: red; color: white; text-align: center;">
           <tr>
               <th style="padding: 10px; border: 1px solid white;">Mission</th>
               <th style="padding: 10px; border: 1px solid white;">Vision</th>
           </tr>
           <tr>
               <td style="padding: 20px; border: 1px solid white;">
                   Our mission is to deliver excellent services and create value for our stakeholders.
               </td>
               <td style="padding: 20px; border: 1px solid white;">
                   Our vision is to be the leading company in our industry, empowering people and driving innovation.
               </td>
           </tr>
       </table>
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
