<?php
// Start the session
session_start();

// Include database connection
include 'db_connect.php';

// Fetch all available rides
function getRides($conn) {
    $sql = "SELECT * FROM rides_services";
    $result = $conn->query($sql);
    return $result;
}

// Join the queue for a specific ride
function joinQueue($conn, $ride_id, $user_id) {
    // Find the current maximum queue position for this ride
    $sql = "SELECT MAX(queue_position) as max_position FROM virtual_queue WHERE ride_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ride_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $new_position = isset($row['max_position']) ? $row['max_position'] + 1 : 1;

    // Insert new queue position for the user
    $sql = "INSERT INTO virtual_queue (ride_id, user_id, queue_position, status) VALUES (?, ?, ?, 'waiting')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $ride_id, $user_id, $new_position);
    $stmt->execute();
    $stmt->close();
    
    // Set a session variable to indicate successful join
    $_SESSION['joined'] = true;
    $_SESSION['ride_id'] = $ride_id; // Store ride ID for further use
    
    // Redirect to dashboard.php
    header("Location: dashboard.php");
    exit();
}

// Fetch user's queue position for a ride
function getUserQueuePosition($conn, $ride_id, $user_id) {
    $sql = "SELECT queue_position, status FROM virtual_queue WHERE ride_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $ride_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Update queue status for a specific ride
function updateQueueStatus($conn, $ride_id) {
    // Get all users in the queue for the specified ride, ordered by queue_position
    $sql = "SELECT id FROM virtual_queue WHERE ride_id = ? ORDER BY queue_position ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ride_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Initialize a counter for positions
    $position = 1;
    
    // Update statuses based on queue position
    while ($row = $result->fetch_assoc()) {
        $queue_id = $row['id'];
        
        if ($position == 1) {
            // First in line: set to 'active'
            $status = 'active';
        } elseif ($position == 2) {
            // Second in line: set to 'near'
            $status = 'near';
        } else {
            // All others: set to 'waiting'
            $status = 'waiting';
        }
        
        // Update status in the virtual_queue table
        $update_sql = "UPDATE virtual_queue SET status = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $status, $queue_id);
        $update_stmt->execute();
        
        // Move to the next position
        $position++;
    }
    
    // Close statements
    $stmt->close();
    if (isset($update_stmt)) $update_stmt->close();
    
    echo "Queue status updated for ride ID: $ride_id.";
}

// Sample user ID - in real applications, this should be fetched dynamically (e.g., from session)
$user_id = 1; // Replace with actual logged-in user ID

// Handling form submission for joining a queue
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ride_id'])) {
    $ride_id = intval($_POST['ride_id']);
    joinQueue($conn, $ride_id, $user_id);
}

// Display rides and queue status
$rides = getRides($conn);

// Example usage to update status for a specific ride
$ride_id = isset($_SESSION['ride_id']) ? $_SESSION['ride_id'] : 1; // Use stored ride ID from session if available
updateQueueStatus($conn, $ride_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Virtual Queue</title>
</head>
<body>
    <h1>Amusement Park Virtual Queue</h1>

    <h2>Available Rides</h2>
    <form method="post" action="virtualQueue.php">
        <?php while ($ride = $rides->fetch_assoc()): ?>
            <div>
                <h3><?php echo htmlspecialchars($ride['name']); ?></h3>
                <button type="submit" name="ride_id" value="<?php echo $ride['id']; ?>">Join Queue</button>
                
                <?php
                // Show queue position if user is already in queue for this ride
                $position = getUserQueuePosition($conn, $ride['id'], $user_id);
                if ($position):
                    echo "<p>Your Queue Position: {$position['queue_position']} - Status: {$position['status']}</p>";
                endif;
                ?>
            </div>
        <?php endwhile; ?>
    </form>
    
    <?php
    // Display a message if the user has joined a queue
    if (isset($_SESSION['joined']) && $_SESSION['joined'] === true) {
        echo "<p>You have successfully joined the queue!</p>";
        unset($_SESSION['joined']); // Clear the session variable after displaying the message
    }
    ?>
</body>
</html>

<?php $conn->close(); ?>

