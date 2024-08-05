<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'citizen') {
  header("Location: login.html");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Citizen</title>
  <link rel="stylesheet" href="dash.css">
</head>
<body>
  <div class="sidebar">
    <h2 >Citizen menu</h2>
    <ul>
    <li><a href="">Dashboard</a></li>
    <li class="dropdown">
      <a href="#users" class="dropdown-btn">Reports</a>
      <ul class="dropdown-content">
        <li><a href="mReport.php">Make report</a></li>
        <li><a href="#Citizens">View Reports</a></li>
      </ul>
    </li>
    <li><a href="">Alerts</a></li>
    </ul>
  </div>

  <div class="topnav">
    <a href="profile.php" class="active">Profile</a>
    <a href="">Settings</a>
    <a href="">Notifications</a>
    <a href="">Alerts</a>
  </div>

  <div class="content">
    <h1>Welcome @ Citizen</h1>

    
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