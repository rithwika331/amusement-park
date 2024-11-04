<?php  
session_start();
include 'db_connect.php'; // Database connection
include 'header2.php'; // Include the header

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Check if the form is submitted to save the updated profile
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $accessibility = $_POST['accessibility'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the new password

    // Update user details in the database
    $update_sql = "UPDATE users SET name='$name', email='$email', accessibility_preferences='$accessibility', password='$password' WHERE id=$user_id";

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php"); // Redirect to profile after successful update
        exit();
    } else {
        $_SESSION['error'] = "Error updating profile.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Page and Footer Positioning */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 50px; /* Space between header and form */
        }

        /* Form Styles */
        form {
            max-width: 400px;
            width: 90%;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            padding: 10px;
            background-color: #2575fc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 90%;
            font-size: 14px;
            transition: opacity 0.3s ease;
        }

        button:hover {
            opacity: 0.9;
        }

        .error-message, .success-message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }

        .error-message {
            background-color: #ffd4d4;
            color: #d32f2f;
        }

        .success-message {
            background-color: #d4ffd4;
            color: #2f7d32;
        }

        h2 {
            text-align: center;
            font-size: 22px;
            margin: 10px 0 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            form {
                max-width: 100%;
                padding: 10px;
            }

            input[type="text"], input[type="email"], input[type="password"] {
                font-size: 13px;
                padding: 7px;
            }

            button {
                padding: 8px;
                font-size: 13px;
            }

            h2 {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            input[type="text"], input[type="email"], input[type="password"] {
                font-size: 12px;
                padding: 6px;
            }

            button {
                padding: 7px;
                font-size: 12px;
            }

            h2 {
                font-size: 18px;
            }
        }

        footer {
            background-color:#E1E5F6;
            color: #333333;;
            text-align: center;
            padding: 20px 0;
            position: relative;
            width: 100%;
            bottom: 0;
        }

    </style>
</head>
<body>

<div class="content">
    <form method="POST">
        <h2>User Profile</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required placeholder="Full Name">
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required placeholder="Email">
        <input type="text" name="accessibility" value="<?= htmlspecialchars($user['accessibility_preferences']) ?>" placeholder="Accessibility Preferences">
        <input type="password" name="password" placeholder="New Password"> <!-- New password field -->
        <button type="submit" name="save_profile">Save Changes</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Accessible Amusement Park. All rights reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>
