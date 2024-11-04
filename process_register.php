<?php
include 'db_connect.php'; // Include the database connection
session_start(); // Start the session

// Handle form submission for registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $accessibility = $_POST['accessibility'];

    // Check if the email is already registered
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        $_SESSION['success_message'] = "Email already exists!";
    } else {
        // Insert into the database
        $sql = "INSERT INTO users (name, email, password, accessibility_preferences) VALUES ('$name', '$email', '$password', '$accessibility')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Registration successful! You can now log in.";
        } else {
            $_SESSION['success_message'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Redirect back to the registration page
    header("Location: register.php");
    exit();
}

$conn->close();
?>
