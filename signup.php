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
        echo "<script>
                alert('Registration successful');
                window.location.href = 'login.html';
              </script>";
    }
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
