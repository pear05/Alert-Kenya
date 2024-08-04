<?php
session_start();
include '../config.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all emergency reports from the database
$sql = "SELECT * FROM emergencies WHERE 'user_id' = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$emergencies = $result->fetch_all(MYSQLI_ASSOC);

// Handle emergency report addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_emergency'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $sql = "INSERT INTO emergency (user_id, title, description, date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $title, $description, $date);

    if ($stmt->execute()) {
        echo "<script>alert('Emergency report added successfully');</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('Error adding emergency report');</script>";
    }
}

// Handle emergency report update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_emergency'])) {
    $emergency_id = $_POST['emergency_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $sql = "UPDATE emergency SET title = ?, description = ?, date = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $title, $description, $date, $emergency_id, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Emergency report updated successfully');</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('Error updating emergency report');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Emergencies</title>
    <link rel="stylesheet" href="report.css">
</head>
<body>
    <div class="container">
        <h1>Manage Emergencies</h1>
        <form action="mReport.php" method="POST">
            <div class="form-group">
                <label for="emergencyTitle">Emergency Title</label>
                <input type="text" id="emergencyTitle" name="emergencyTitle" placeholder="Enter emergency title" required>
            </div>
            <div class="form-group">
                <label for="emergencyType">Type of Emergency</label>
                <select id="emergencyType" name="emergencyType">
                    <option value="naturalDisaster">Natural Disaster</option>
                    <option value="accident">Accident</option>
                    <option value="health">Health</option>
                    <option value="crime">Crime</option>
                </select>
            </div>
            <div class="form-group">
                <label for="severity">Severity</label>
                <select id="severity" name="severity">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Enter location" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="Enter description" required></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="images">Upload Images</label>
                <input type="file" id="images" name="images" multiple>
            </div>
            <div class="form-group">
                <label for="documents">Upload Documents</label>
                <input type="file" id="documents" name="documents" multiple>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
