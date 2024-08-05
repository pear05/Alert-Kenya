<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'responder') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="dash.css">
</head>
<body>
  <div class="sidebar">
    <h2 >Admin menu</h2>
    <ul>
    <li><a href="">Dashboard</a></li>
    <li><a href="">Reports</a></li>
    <li class="dropdown">
      <a href="#users" class="dropdown-btn">Users</a>
      <ul class="dropdown-content">
        <li><a href="#admin">Admin</a></li>
        <li><a href="#Citizens">Citizen</a></li>
        <li><a href="#Responders">Responder</a></li>
      </ul>
    </li>
    <li><a href="">Alerts</a></li>
    <li><a href="">Tally</a></li>
    </ul>
  </div>

  <div class="topnav">
    <a href="" class="active">Profile</a>
    <a href="">Settings</a>
    <a href="">Notifications</a>
    <a href="">Alerts</a>
  </div>

  <div class="content">
    <h1>Welcome @ admin</h1>

    <div class="recent-card">
      <h2>Latest Activities</h2>
      <ul id="activity-list">
        <?php
include 'config.php'; // Include your database connection

$query = "SELECT * FROM activities ORDER BY created_at DESC LIMIT 10"; // Adjust query as needed
$result = $conn->query($query);

$activities = array();
while ($row = $result->fetch_assoc()) {
    $activities[] = $row;
}

echo json_encode($activities);
?>

      </ul>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    fetch('get_activities.php')
        .then(response => response.json())
        .then(data => {
            const activityList = document.getElementById('activity-list');
            data.forEach(activity => {
                const li = document.createElement('li');
                li.textContent = `${activity.description} - ${new Date(activity.created_at).toLocaleString()}`;
                activityList.appendChild(li);
            });
        })
        .catch(error => console.error('Error fetching activities:', error));
});
  </script>
  <script>
        document.querySelector('.dropdown-btn').addEventListener('click', function() {
            this.classList.toggle('active');
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    </script>
</body>
</html>