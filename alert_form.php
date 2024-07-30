<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Edit Alert</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include 'config.php';
    session_start();

    $alert_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $alert = ['title' => '', 'description' => ''];

    if ($alert_id) {
        $stmt = $conn->prepare("SELECT title, description FROM alerts WHERE id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $alert_id);
        $stmt->execute();
        $stmt->bind_result($alert['title'], $alert['description']);
        
        if ($stmt->fetch()) {
            // Successfully fetched the alert
        } else {
            echo "No alert found with ID " . $alert_id;
        }
        $stmt->close();
    }
    ?>

    <h1><?php echo $alert_id ? 'Edit Alert' : 'Add New Alert'; ?></h1>
    <form action="process_alert.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($alert_id); ?>">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($alert['title']); ?>" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($alert['description']); ?></textarea>
    <br>
    <button type="submit"><?php echo $alert_id ? 'Update Alert' : 'Add Alert'; ?></button>
</form>

    <a href="alerts.php">Back to Alerts List</a>
</body>
</html>
