<?php
$servername = "localhost"; // or your database server IP
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "alert_kenya";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
