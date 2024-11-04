

<?php

// Set session timeout duration (in seconds)
$timeout_duration = 600; // 10 minutes

// Check if "last activity" is set
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calculate the session lifetime
    if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration) {
        // Last activity is longer than timeout_duration, so log out the user
        session_unset();     // Unset session variables
        session_destroy();   // Destroy the session
        header("Location: index.php?logged_out=true"); // Redirect to index.php after logging out
        exit();
    }
}

// Update last activity timestamp
$_SESSION['LAST_ACTIVITY'] = time();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Accessible Amusement Park</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS file -->
</head>

<style>

form {
    width: 80%;
    max-width: 400px; /* Max width for form */
    margin: 0 auto; /* Center the form */
    padding: 20px;
    background-color:skyblue;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    font-size: 16px;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
    background-color: #f9f9f9;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}
footer {

            text-align: center;
            padding: 5px 0; /* Padding for a thin look */
        }

</style>


<body>
    <header>
        <div class="logo-container">
            <img src="images/logo.png" alt="Accessible Amusement Park Logo" class="logo">
            <h1>Welcome to the Accessible Amusement Park</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Login to Your Account</h2>

            <!-- Display session message if available -->
            <?php session_start(); ?>
            <?php if (isset($_SESSION['login_message'])): ?>
                <div class="message <?php echo $_SESSION['message_type']; ?>">
                    <?php
                    echo $_SESSION['login_message'];
                    unset($_SESSION['login_message']); // Clear message after displaying
                    unset($_SESSION['message_type']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="process_login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
                <a href="register.php" class="register-link">Register</a> <!-- Register button -->
            </form>

            <!-- Forgot Password link -->
            <p><a href="forgot_password.php" class="forgot-password-link">Forgot Password?</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Accessible Amusement Park. All rights reserved.</p>
    </footer>
</body>
</html>
