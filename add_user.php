<?php
// Start the session
session_start();

// Include the database connection
include 'db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $accessibility_preferences = $_POST['accessibility_preferences'];

    // Hash the password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert user data
    $sql = "INSERT INTO users (name, email, password, accessibility_preferences) VALUES (?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $accessibility_preferences);

        // Execute the statement
        if ($stmt->execute()) {
            // Set success message in session
            $_SESSION['success_message'] = "User added successfully!";
            
            // Redirect to admindashboard.php after successfully adding user
            header("Location: admindashboard.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Error adding user: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Error preparing query: " . $conn->error;
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
    <title>Add User - Accessible Amusement Park</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        form {
            width: 80%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: skyblue;
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

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- Include the admin header -->
    <?php include 'adminheader.php'; ?>

    <main>
        <section>
            <h2>Add New User</h2>

            <!-- Display error message if session contains one -->
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="error-message">
                    <?php
                    echo $_SESSION['error_message'];
                    unset($_SESSION['error_message']); // Remove message after displaying
                    ?>
                </div>
            <?php endif; ?>

            <!-- Display success message if session contains one -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="success-message">
                    <?php
                    echo $_SESSION['success_message'];
                    unset($_SESSION['success_message']); // Remove message after displaying
                    ?>
                </div>
            <?php endif; ?>

            <!-- Add User Form -->
            <form action="" method="POST">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="accessibility_preferences">Accessibility Preferences:</label>
                <input type="text" id="accessibility_preferences" name="accessibility_preferences">

                <button type="submit">Add User</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Accessible Amusement Park. All rights reserved.</p>
    </footer>
</body>
</html>
