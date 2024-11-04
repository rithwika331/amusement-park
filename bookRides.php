<?php
session_start();
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amusement Park Booking Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #8CB3FC;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 90%; /* Responsive max width */
            width: 350px; /* Fixed width for larger screens */
            margin: 10px; /* Margin for smaller screens */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px; /* Reduced margin for smaller screens */
            
        }

        .success-message,
        .error-message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px; /* Reduced margin for smaller screens */
            text-align: center;
            font-weight: bold;
        }

        .success-message {
            background-color: #e0ffd4;
            color: #2e7d32;
            border: 1px solid #66bb6a;
        }

        .error-message {
            background-color: #ffd4d4;
            color: #c62828;
            border: 1px solid #e57373;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #fff;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px; /* Reduced margin for smaller screens */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            background-color: white;
        }

        .login-btn { 
    padding: 10px;
    font-size: 16px; /* Increased font size for better readability */
    color: white;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    outline: none;
    font-weight: bold;
    width: 200px; /* Set a specific width for centering */
    margin: 0 auto; /* Center button */
}

        .login-btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .login-btn:active {
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
            transform: translateY(0);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 480px) {
            .container {
                padding: 15px; /* Adjust padding for smaller screens */
                max-width: 100%; /* Ensure full width on small screens */
            }

            h2 {
                margin-bottom: 15px; /* Adjust heading margin for small screens */
            }

            .login-btn {
                font-size: 14px; /* Adjust button font size for small screens */
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="highlight">Book Your Ride or Service</h2>
        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='success-message'>";
            echo $_SESSION['success'];
            echo "</div>";
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo "<div class='error-message'>";
            echo $_SESSION['error'];
            echo "</div>";
            unset($_SESSION['error']);
        }

        // Retain the form values
        $first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
        $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
        $ride_service = isset($_SESSION['ride_service']) ? $_SESSION['ride_service'] : '';
        ?>

        <form action="process_booking.php" method="POST">
            <!-- First Name -->
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <!-- Select Ride or Service -->
            <label for="ride_service">Select Ride or Service:</label>
            <select id="ride_service" name="ride_service" required>
                <option value="">-- Select an Option --</option>
                <option value="Rollercoaster" <?php if($ride_service == "Rollercoaster") echo 'selected'; ?>>Rollercoaster</option>
                <option value="Water Park" <?php if($ride_service == "Water Park") echo 'selected'; ?>>Water Park</option>
                <option value="Ferris Wheel" <?php if($ride_service == "Ferris Wheel") echo 'selected'; ?>>Ferris Wheel</option>
                <option value="Bumper Cars" <?php if($ride_service == "Bumper Cars") echo 'selected'; ?>>Bumper Cars</option>
            </select>

            <!-- Submit Button -->
            <button type="submit" class="login-btn">Book Now</button>
        </form>
    </div>

</body>
</html>
