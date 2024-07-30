<?php
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Fetch all alerts from the database
$alerts = [];
$result = $conn->query("SELECT title, description FROM alerts");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alerts[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dash.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">
            <img src="logo.png" alt="Logo" class="logo">
            <span>Alert Kenya</span>
        </div>
        <div class="navbar-user">
            <img src="user.png" alt="User" class="user-profile">
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
    </div>
    <div class="container">
        <div class="sidebar">
            <ul class="nav-links">
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="alert.php">Manage Alerts</a></li>
                <li><a href="#">Map</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            </div>
            <div class="content">
                <div class="map-container">
                    <div id="map"></div>
                </div>
                <div class="notifications">
                    <h2>Recent Alerts</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($alerts)): ?>
                                <tr>
                                    <td colspan="2">No alerts found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($alerts as $alert): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($alert['title']); ?></td>
                                        <td><?php echo htmlspecialchars($alert['description']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="script.js"></script>
</body>
</html>
