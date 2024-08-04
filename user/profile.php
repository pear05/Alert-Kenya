<?php
include '../config.php';

// Assume the user is logged in and their user ID is stored in the session
session_start();
$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update user details
    $username = $_POST['username'];
    $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $designation = $_POST['designation'];
    $age = $_POST['age'];
    $experience = $_POST['experience'];
    $bio = $_POST['bio'];

    $update_sql = "UPDATE users SET username = ?, role = ?, name = ?, email = ?, phone = ?, designation = ?, age = ?, experience = ?, bio = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssssiiii", $username, $role, $name, $email, $phone, $designation, $age, $experience, $bio, $user_id);

    if ($update_stmt->execute()) {
        echo "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $update_stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
<body>
    <div class="container">
        <div class="profile-header">
            <img src="path/to/profile/image.jpg" alt="Profile Picture">
            <div class="info">
                <h2><?php echo $user['name']; ?></h2>
                <div class="role"><?php echo ucfirst($user['role']); ?></div>
                <div class="location">Location: <?php echo $user['location']; ?></div>
                <div class="stats">
                    <div>
                        <h3>113</h3>
                        <p>Projects</p>
                    </div>
                    <div>
                        <h3>12.2k</h3>
                        <p>Followers</p>
                    </div>
                    <div>
                        <h3>128</h3>
                        <p>Following</p>
                    </div>
                </div>
            </div>
            <div class="actions">
                <button class="button">+ Follow</button>
            </div>
        </div>

        <div class="profile-details">
            <div class="left">
                <div class="section">
                    <h3>Profile Status</h3>
                    <p>Profile 60% completed - <a href="#">Finish now</a></p>
                </div>
                <div class="section">
                    <h3>Professional Bio</h3>
                    <p><?php echo $user['bio']; ?></p>
                </div>
                <div class="section">
                    <h3>Personal Info</h3>
                    <p>Name: <?php echo $user['name']; ?></p>
                    <p>Email: <?php echo $user['email']; ?></p>
                    <p>Phone: <?php echo $user['phone']; ?></p>
                    <p>Designation: <?php echo $user['designation']; ?></p>
                    <p>Age: <?php echo $user['age']; ?></p>
                    <p>Experience: <?php echo $user['experience']; ?> years</p>
                </div>
            </div>
            <div class="right">
                <div class="section">
                    <h3>Activity</h3>
                    <!-- Add user activity details here -->
                </div>
                <div class="section">
                    <h3>Followers</h3>
                    <!-- Add followers details here -->
                </div>
                <div class="section">
                    <h3>Friends</h3>
                    <!-- Add friends details here -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>