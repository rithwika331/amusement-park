<?php 
session_start();
include 'db_connect.php';

// Fetch unread notifications for the logged-in user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM notifications WHERE user_id = $user_id AND status = 'unread' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$notifications = [];
while ($row = mysqli_fetch_assoc($result)) {
    $notifications[] = $row;
}

// Mark notifications as read when requested
if (isset($_POST['markAsRead'])) {
    $markAsReadQuery = "UPDATE notifications SET status = 'read' WHERE user_id = $user_id";
    mysqli_query($conn, $markAsReadQuery);
    echo 'success';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        .notification { padding: 10px; border-bottom: 1px solid #ddd; }
        .unread { font-weight: bold; }
    </style>
</head>
<body>
    <h2>The following are the notifications for booking:</h2>
    <div id="notifications-container">
        <?php if (!empty($notifications)): ?>
            <?php foreach ($notifications as $notification): ?>
                <div class="notification unread">
                    <?php echo htmlspecialchars($notification['message']); ?>
                    <small><?php echo $notification['created_at']; ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No new notifications.</p>
        <?php endif; ?>
    </div>

    <script>
        // Poll for new notifications every 5 seconds
        setInterval(fetchNotifications, 5000);

        function fetchNotifications() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "realTimeNotifications.php?fetch=1", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("notifications-container").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>

<?php
// If fetching via AJAX, render notifications dynamically
if (isset($_GET['fetch'])) {
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="notification unread">';
            echo htmlspecialchars($row['message']) . "<small>" . $row['created_at'] . "</small>";
            echo '</div>';
        }
    } else {
        echo '<p>No new notifications.</p>';
    }
    exit();
}
?>
