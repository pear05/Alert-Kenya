<?php
// Include the database configuration file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing
    $telephone = $_POST['telephone'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (email, username, password, telephone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $username, $password, $telephone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
