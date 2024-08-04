<?php
// Include the database configuration file
include 'config.php';

// Start session to manage user login state
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>


<!-- // Fetch user from database
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // Set session variables
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // Redirect based on user role
    if ($user['role'] == 'admin') {
        header("Location: admin_dashboard.php");
    } elseif ($user['role'] == 'teacher') {
        header("Location: teacher_dashboard.php");
    } elseif ($user['role'] == 'student') {
        header("Location: student_dashboard.php");
    } else {
        header("Location: index.php"); // Default fallback
    }
} else {
    // Invalid credentials
    echo "Invalid username or password";
}
?> -->
