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

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['login_message'] = "Login successful! Welcome back, " . $user['name'] . ".";
            $_SESSION['message_type'] = "success"; // Message type for styling
            // Set session variables for logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            
            // Redirect to the user dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['login_message'] = "Incorrect password. Please try again.";
            $_SESSION['message_type'] = "error";
            // Redirect back to login page
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_message'] = "No account found with this email. Please register.";
        $_SESSION['message_type'] = "error";
        // Redirect to the registration page
        header("Location: register.php");
        exit();
    }
}

$conn->close();
?>
