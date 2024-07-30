<?php
<<<<<<< HEAD
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
=======
$servername = "localhost"; // or your database server IP
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
>>>>>>> a766ab3022e60a272f88efe2fe517c0af11606d7
$dbname = "Alert_Kenya";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
<<<<<<< HEAD
=======
echo "Connected successfully";
>>>>>>> a766ab3022e60a272f88efe2fe517c0af11606d7
?>
