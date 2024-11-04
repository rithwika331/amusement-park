<?php  
session_start();
include 'db_connect.php'; // Database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $ride_service = $_POST['ride_service'];
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Validate inputs
    if (!empty($first_name) && !empty($email) && !empty($ride_service)) {
        // Prepare SQL query to insert the booking into the database
        $sql = "INSERT INTO bookings (first_name, email, ride_service, user_id) VALUES ('$first_name', '$email', '$ride_service', '$user_id')";
        
        if (mysqli_query($conn, $sql)) {
            // Set success message in session
            $_SESSION['success'] = "Your booking for the $ride_service is confirmed!";

            // Insert a notification for the booking confirmation
            $notification_message = "Your booking for $ride_service is confirmed!";
            $notification_sql = "INSERT INTO notifications (user_id, message, status) VALUES ('$user_id', '$notification_message', 'unread')";
            mysqli_query($conn, $notification_sql);
        } else {
            $_SESSION['error'] = "There was an error processing your booking. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Please fill in all fields."; // Optional: Handle empty fields
    }

    // Redirect back to the booking page
    header("Location: dashboard.php");
    exit();
}
?>
