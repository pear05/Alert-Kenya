<?php
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Get the alert ID from the URL
$alert_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($alert_id > 0) {
    // Fetch the alert details from the database
    $stmt = $conn->prepare("SELECT title, description FROM alerts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $alert_id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($title, $description);
    $stmt->fetch();
    $stmt->close();

    // If no alert found, redirect to the alerts list
    if (empty($title)) {
        header("Location: manage_alerts.php");
        exit;
    }
} else {
    header("Location: manage_alerts.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alert</title>
    <link rel="stylesheet" href="alert.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Edit Alert</h1>
            <nav>
                <a href="manage_alerts.php">Back to Alerts List</a>
            </nav>
        </header>

        <div class="alert-form">
            <form action="process_alert.php" method="post">
                <input type="hidden" name="id" value="<?php echo $alert_id; ?>">
                <label for="title">Title and Location:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
                <br>
                <button type="submit">Update Alert</button>
            </form>
        </div>
    </div>
</body>
</html>
