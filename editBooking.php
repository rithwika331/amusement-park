<?php     
session_start();
include 'db_connect.php'; // Database connection
include 'header2.php'; // Include the header

// Check if booking ID is provided
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    
    // Fetch booking details
    $sql = "SELECT * FROM bookings WHERE id = $booking_id";
    $result = mysqli_query($conn, $sql);
    $booking = mysqli_fetch_assoc($result);
    
    // Check if the form is submitted to save the updated booking
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_booking'])) {
        $first_name = $_POST['first_name'];
        $email = $_POST['email'];
        $ride_service = $_POST['ride_service'];

        // Update booking in the database
        $update_sql = "UPDATE bookings SET first_name='$first_name', email='$email', ride_service='$ride_service' WHERE id=$booking_id";

        if (mysqli_query($conn, $update_sql)) {
            $_SESSION['success'] = "Booking updated successfully!";
            header("Location: dashboard.php"); // Redirect to dashboard after successful update
            exit();
        } else {
            $_SESSION['error'] = "Error updating booking.";
        }
    }
} else {
    $_SESSION['error'] = "No booking ID provided.";
    header("Location: manageBookings.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<style>
    /* styles.css */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    form {
        max-width: 90%; /* Changed from 500px to 90% for better responsiveness */
        margin: 120px auto 100px auto; /* Top margin added to separate form from header */
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Ensure no overflow */
    }

    input[type="text"], input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        padding: 10px 15px;
        background-color: #2575fc;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%; /* Make button full width */
    }

    button:hover {
        opacity: 0.8;
    }

    .error-message, .success-message {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .error-message {
        background-color: #ffd4d4;
        color: #d32f2f;
    }

    .success-message {
        background-color: #d4ffd4;
        color: #2f7d32;
    }

    /* Responsive styles */
    @media (max-width: 600px) {
        form {
            margin: 80px 10px 80px 10px; /* Reduce side margins on smaller screens */
            padding: 15px;
        }

        header, footer {
            padding: 5px 0;
        }

        button {
            padding: 12px;
        }
    }
</style>

<h2 style="text-align: center; margin-top:90px;">Edit Booking</h2>

<?php if (isset($_SESSION['success'])): ?>
    <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="POST">
    <input type="text" name="first_name" value="<?= htmlspecialchars($booking['first_name']) ?>" required placeholder="First Name">
    <input type="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required placeholder="Email">
    <input type="text" name="ride_service" value="<?= htmlspecialchars($booking['ride_service']) ?>" required placeholder="Ride/Service">
    <button type="submit" name="save_booking">Save Booking</button>
</form>

<?php include 'footer.php'; // Include the footer ?>

</body>
</html>
