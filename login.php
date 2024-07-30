<?php
// Include the database configuration file
include 'config.php';

// Start session to manage user login state
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
<<<<<<< HEAD
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    
    // Bind parameters and execute the statement
    $stmt->bind_param("s", $email);
=======
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
>>>>>>> a766ab3022e60a272f88efe2fe517c0af11606d7
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
<<<<<<< HEAD
        $stmt->bind_result($user_id, $hashed_password);
=======
        $stmt->bind_result($hashed_password);
>>>>>>> a766ab3022e60a272f88efe2fe517c0af11606d7
        $stmt->fetch();

        // Verify the hashed password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
<<<<<<< HEAD
            $_SESSION['user_id'] = $user_id;
=======
>>>>>>> a766ab3022e60a272f88efe2fe517c0af11606d7
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
