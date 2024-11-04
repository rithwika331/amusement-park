<?php
// Start the session for messaging
session_start();

// Include the database connection
include 'db_connect.php';

// Verify that action and queue ID are set
if (isset($_GET['action']) && isset($_GET['queue_id'])) {
    $action = $_GET['action'];
    $queue_id = intval($_GET['queue_id']); // Sanitize queue ID to ensure it's an integer

    // Delete action
    if ($action === 'delete') {
        $sql = "DELETE FROM virtual_queue WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $queue_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Queue entry deleted successfully.";
        } else {
            $_SESSION['message'] = "Error deleting entry: " . $conn->error;
        }
        $stmt->close();

    // Update action
    } elseif ($action === 'update' && isset($_GET['new_status'])) {
        $new_status = $_GET['new_status'];

        $sql = "UPDATE virtual_queue SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_status, $queue_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Queue status updated successfully.";
        } else {
            $_SESSION['message'] = "Error updating status: " . $conn->error;
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Invalid action or missing parameters.";
    }

    // Redirect back to manageque.php
    header("Location: admindashboard.php");
    exit;

} else {
    // No action provided; redirect with an error message
    $_SESSION['message'] = "No action specified.";
    header("Location: admindashboard.php");
    exit;
}

// Close the database connection
$conn->close();
?>
