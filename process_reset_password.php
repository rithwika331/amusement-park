<?php
include 'db_connect.php'; // Include the database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Find the email associated with this token
    $sql = "SELECT email FROM password_resets WHERE token='$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Update the password for the user
        $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            // Delete the token from the password_resets table
            $sql = "DELETE FROM password_resets WHERE token='$token'";
            $conn->query($sql);

            $_SESSION['message'] = "Your password has been successfully reset!";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['message'] = "Error updating password. Please try again.";
        }
    } else {
        $_SESSION['message'] = "Invalid or expired token.";
    }

    header("Location: reset_password.php?token=$token");
    exit();
}

$conn->close();
?>
