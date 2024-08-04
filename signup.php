<?php
// Include the database configuration file
include 'config.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $designation = $_POST['designation'];
    $age = $_POST['age'];
    $experience = $_POST['experience'];
    $bio = $_POST['bio'];

    // Insert the user into the database
    $sql = "INSERT INTO users (username, password, role, name, email, phone, designation, age, experience, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssiis", $username, $password, $role, $name, $email, $phone, $designation, $age, $experience, $bio);

    if ($stmt->execute()) {
        // Registration successful, redirect based on role
        session_start();
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['role'] = $role;

        if ($role == 'admin') {
            header("Location: admin_dashboard.php");
        } elseif($role == 'responder'){
            header("Location: responder_dashboard.php");
        } elseif($role == 'citizen'){
            header("Location: citizen_dashboard.php");
        }
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
