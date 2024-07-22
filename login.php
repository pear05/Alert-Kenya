<?php
// Include the database configuration file
include 'config.php';

// Start session to manage user login state
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the hashed password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            header("Location: dash.php"); // Redirect to the PHP dashboard
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
