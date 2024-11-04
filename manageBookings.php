<?php     
session_start();
include 'db_connect.php'; // Database connection
include 'header.php'; // Include the header

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch bookings for the logged-in user only
$sql = "SELECT * FROM bookings WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// Ensure query execution was successful
if (!$result) {
    die("Error fetching bookings: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Your Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
        }

        h1 {
            text-align: center;
            font-size: 2.5em; 
            color: #333;
            margin-bottom: 20px; 
        }

        table {
            width: 90%; 
            max-width: 600px; 
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            margin: 0 auto; 
        }

        th, td {
            padding: 12px; 
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #65558F;
            color: white;
            font-size: 1.1em; 
        }

        td {
            background-color: #fff;
            font-size: 1em; 
        }

        tr:hover {
            background-color: #f1f1f1; 
        }

        .edit-btn {
            padding: 8px 12px; 
            cursor: pointer;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: #6a11cb;
            text-decoration: none;
            transition: background-color 0.3s;
            font-size: 0.9em; 
            display: inline-block; 
            text-align: center; 
        }

        .edit-btn:hover {
            background-color: #4e0ea7; 
        }

        .success-message, .error-message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            width: 90%; 
            max-width: 600px; 
        }

        .success-message {
            background-color: #e0ffd4;
            color: #2e7d32; 
        }

        .error-message {
            background-color: #ffd4d4;
            color: #d32f2f; 
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2em; 
            }

            th, td {
                padding: 0px; 
                font-size: 0.9em; 
            }

            .edit-btn {
                font-size: 0.8em; 
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8em; 
            }

            th, td {
                padding: 6px; 
                font-size: 0.8em; 
            }

            .edit-btn {
                padding: 6px 10px; 
                font-size: 0.7em; 
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?> <!-- Include Header -->

<h1>Manage Your Rides and Bookings</h1>

<?php if (isset($_SESSION['success'])): ?>
    <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Email</th>
            <th>Ride/Service</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($booking = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($booking['first_name']) ?></td>
                <td><?= htmlspecialchars($booking['email']) ?></td>
                <td><?= htmlspecialchars($booking['ride_service']) ?></td>
                <td>
                    <a href="editBooking.php?id=<?= $booking['id'] ?>" class="edit-btn">Edit</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
