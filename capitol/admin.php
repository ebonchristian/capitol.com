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

// Handle Create
if (isset($_POST['add_employee'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $date_hired = $_POST['date_hired'];

    $sql = "INSERT INTO employees (name, email, position, salary, date_hired)
            VALUES ('$name', '$email', '$position', '$salary', '$date_hired')";
    $conn->query($sql);
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM employees WHERE id = $id";
    $conn->query($sql);
}

// Fetch employees for display
$employees = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <a href="index.php" class="back-button">&larr; Back to Home</a>

        <header>
            <h1>Admin Panel</h1>
        </header>
        <section>
            <h2>Add Employee</h2>
            <form method="POST" class="form">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="position" placeholder="Position" required>
                <input type="number" name="salary" step="0.01" placeholder="Salary" required>
                <input type="date" name="date_hired" required>
                <button type="submit" name="add_employee">Add Employee</button>
            </form>
        </section>
        <section>
            <h2>Employee List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Date Hired</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $employees->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['position'] ?></td>
                            <td><?= $row['salary'] ?></td>
                            <td><?= $row['date_hired'] ?></td>
                            <td>
                                <a href="edit_employee.php?id=<?= $row['id'] ?>">Edit</a>
                                <a href="admin.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
