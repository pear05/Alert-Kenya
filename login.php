<?php
// Include the database configuration file
include 'config.php';

// Start session to manage user login state
session_start();

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
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: ../Alert-Kenya/admin/admin_dashboard.php");
        } elseif($user['role'] == 'responder') {
            header("Location: ../Alert-Kenya/responder_dashboard.php");
        }
         elseif ($user['role'] == 'citizen') {
            header("Location: ../Alert-Kenya/user/user_dashboard.php");
         }
        exit();
    } else {
        echo "Invalid username or password";
    }
    $stmt->close();
}

$conn->close();
?>