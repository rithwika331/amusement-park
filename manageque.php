<?php 
// Start the session
session_start();

// Include the database connection
include 'db_connect.php';

// Fetch queue data directly
$sql = "SELECT v.id AS queue_id, v.queue_position, v.status, r.name AS ride_name, u.name AS user_name
        FROM virtual_queue v
        JOIN rides_services r ON v.ride_id = r.id
        JOIN users u ON v.user_id = u.id
        ORDER BY r.id, v.queue_position ASC";
$queue = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Virtual Queue Management</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: center; }
        th { background-color: #0B244D; color: white; }
        .btn { padding: 5px 10px; cursor: pointer; border: none; }
        .btn-update { background-color: #28a745; color: white; }
        .btn-delete { background-color: #dc3545; color: white; }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</head>
<body>
    <h1>Admin - Virtual Queue Management</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']); // Clear the message
    }
    ?>
    <table>
        <thead>
            <tr>
                <th>Queue ID</th>
                <th>Ride Name</th>
                <th>User Name</th>
                <th>Position</th>
                <th>Status</th>
                <th>Update Status</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $queue->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['queue_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['ride_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo $row['queue_position']; ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <select onchange="window.location.href='adminQueueActions.php?action=update&queue_id=<?php echo $row['queue_id']; ?>&new_status=' + this.value;">
                            <option value="waiting" <?php if ($row['status'] === 'waiting') echo 'selected'; ?>>Waiting</option>
                            <option value="near" <?php if ($row['status'] === 'near') echo 'selected'; ?>>Near</option>
                            <option value="active" <?php if ($row['status'] === 'active') echo 'selected'; ?>>Active</option>
                        </select>
                    </td>
                    <td>
                        <a href="adminQueueActions.php?action=update&queue_id=<?php echo $row['queue_id']; ?>&new_status=active" class="btn btn-update">Update</a>
                    </td>
                    <td>
                        <a href="adminQueueActions.php?action=delete&queue_id=<?php echo $row['queue_id']; ?>" class="btn btn-delete" onclick="return confirmDelete();">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>

