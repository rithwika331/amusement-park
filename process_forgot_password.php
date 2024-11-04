<?php
include 'db_connect.php'; // Include the database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));

        // Store the token in the database (typically a password_resets table)
        $sql = "INSERT INTO password_resets (email, token) VALUES ('$email', '$token')";
        if ($conn->query($sql) === TRUE) {
            // Prepare the reset link
            $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;
            
            // Email details
            $subject = "Password Reset Request";
            $message = "Click the link below to reset your password:\n\n" . $reset_link;
            $headers = "From: no-reply@yourwebsite.com\r\n";
            
            // Send the email
            if (mail($email, $subject, $message, $headers)) {
                $_SESSION['message'] = "A password reset link has been sent to your email address.";
            } else {
                $_SESSION['message'] = "Failed to send email. Please try again.";
            }
        } else {
            $_SESSION['message'] = "Error processing request. Please try again.";
        }
    } else {
        $_SESSION['message'] = "No account found with that email address.";
    }

    // Redirect to the forgot password page
    header("Location: forgot_password.php");
    exit();
}

$conn->close();
?>
