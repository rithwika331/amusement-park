<?php 
include 'db_connect.php'; // Include the database connection

// Check if a session is already active
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it's not already active
}

// Handle form submission for login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for admin credentials
    if ($email == 'admin@123' && $password == 'admin') {
        // Set session for admin
        $_SESSION['login_message'] = "Login successful! Welcome, Admin.";
        $_SESSION['message_type'] = "success"; 
        $_SESSION['user_role'] = 'admin';
        $_SESSION['user_name'] = 'Admin';
        
        // Redirect to admin dashboard
        header("Location:admindashboard.php");
        exit();
    } else {
        // Credentials are incorrect
        $_SESSION['login_message'] = "Incorrect email or password. Please try again.";
        $_SESSION['message_type'] = "error";
        
        // Redirect back to login page
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>
