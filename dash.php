<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your dashboard, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1>
    <p><a href="logout.php">Log out</a></p>
    <!-- Add more dynamic content here -->
</body>
</html>
    