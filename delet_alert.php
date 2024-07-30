<?php
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Check if the alert ID is set in the URL
if (isset($_GET['id'])) {
    $alert_id = intval($_GET['id']);

    // Prepare SQL query to delete the alert
    $stmt = $conn->prepare("DELETE FROM alerts WHERE id = ?");
    $stmt->bind_param("i", $alert_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to manage alerts page after successful deletion
        header("Location: manage_alerts.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid alert ID.";
}
?>
