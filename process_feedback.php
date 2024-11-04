<?php
// Start session
session_start();

// Include the database connection
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $date = $conn->real_escape_string($_POST['date']);
    $comments = $conn->real_escape_string($_POST['comments']);
    $rating = intval($_POST['rating']);

    // Insert the data into the database
    $sql = "INSERT INTO feedback (name, email, visit_date, comments, rating) 
            VALUES ('$name', '$email', '$date', '$comments', $rating)";

    if ($conn->query($sql) === TRUE) {
        // Set session feedback message
        $_SESSION['feedback'] = "Feedback submitted successfully!";
        // Redirect to the dashboard
        header("Location:dashboard.php");
        exit();
    } else {
        $_SESSION['feedback'] = "Error: " . $conn->error;
        // Redirect back to the feedback form
        header("Location: submitFeedback.php");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
