<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id']; // Ensure user is logged in and this session variable is set

    // Prepare SQL query
    if ($id > 0) {
        // Update existing alert
        $stmt = $conn->prepare("UPDATE alerts SET title = ?, description = ? WHERE id = ? AND user_id = ?");
    } else {
        // Insert new alert
        $stmt = $conn->prepare("INSERT INTO alerts (title, description, user_id) VALUES (?, ?, ?)");
    }

    // Check if prepare succeeded
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    if ($id > 0) {
        $stmt->bind_param("ssii", $title, $description, $id, $user_id);
    } else {
        $stmt->bind_param("ssi", $title, $description, $user_id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to alerts page after successful operation
        header("Location: dash.php");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
