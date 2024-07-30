<?php
include 'config.php';
session_start();

// Fetch all alerts from the database
$alerts = [];
$result = $conn->query("SELECT id, title, description FROM alerts");

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
    <title>Manage Alerts</title>
    <link rel="stylesheet" href="alert.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Alerts</h1>
            <nav>
                <a href="dash.php">Back to Dashboard</a>
            </nav>
        </header>

        <div class="alert-form">
            <h2>Add New Alert</h2>
            <form action="process_alert.php" method="post">
                <input type="hidden" name="id" value="">
                <label for="title">Title and Location:</label>
                <input type="text" id="title" name="title" required>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
                <br>
                <button type="submit">Add Alert</button>
            </form>
        </div>

        <div class="alert-list">
    <h2>Existing Alerts</h2>
    <table>
        <thead>
            <tr>
                <th>Title and Location</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($alerts)): ?>
                <tr>
                    <td colspan="3">No alerts found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($alerts as $alert): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($alert['title']); ?></td>
                        <td><?php echo htmlspecialchars($alert['description']); ?></td>
                        <td>
                            <a href="edit_alert.php?id=<?php echo $alert['id']; ?>">Edit</a>
                            <a href="delete_alert.php?id=<?php echo $alert['id']; ?>" onclick="return confirm('Are you sure you want to delete this alert?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
                </body>
</html>

