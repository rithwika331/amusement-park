<?php 
// Start the session
session_start();

// Include the database connection
include 'db_connect.php';

// Initialize variables for feedback messages
$success_message = '';
$error_message = '';

// Check if the user ID is set and the form was submitted
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the SQL query to delete user data
    $sql = "DELETE FROM users WHERE id = ?";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Set success message in session
            $success_message = "User deleted successfully!";
        } else {
            $error_message = "Error deleting user: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $error_message = "Error preparing query: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User - Accessible Amusement Park</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .message {
            margin: 20px auto;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <!-- Include the admin header -->
    <?php include 'adminheader.php'; ?>

    <main>
        <section>
            <h2>Delete User</h2>

            <!-- Display error message if available -->
            <?php if ($error_message): ?>
                <div class="message error">
                    <?php
                    echo $error_message;
                    ?>
                </div>
            <?php endif; ?>

            <!-- Display success message if available -->
            <?php if ($success_message): ?>
                <div class="message success">
                    <?php
                    echo $success_message;
                    ?>
                </div>
            <?php endif; ?>
            
            <!-- Provide a link back to the users page -->
            <a href=" admindas.php" class="btn btn-primary">Back to Registered Users</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Accessible Amusement Park. All rights reserved.</p>
    </footer>
</body>
</html>
