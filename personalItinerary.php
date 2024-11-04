<?php
// Start the session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db_connect.php';

// Retrieve rides/services from the database
$sql = "SELECT id, name FROM rides_services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized Itinerary Planner</title>
    <style>
        /* General container styling */
.container {
    max-width: 1000px; /* Increase maximum width for larger screens */
    width: 90%; /* Make container width responsive with a percentage */
    margin: 0 auto; /* Center the container */
    padding: 20px; /* Padding for the container */
    font-family: Arial, sans-serif; /* Font for the text */
    background-color: #f9f9f9; /* Light background for the container */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 15px; /* Reduce padding for smaller screens */
    }
}

@media (max-width: 480px) {
    .container {
        padding: 10px; /* Further reduce padding for very small screens */
    }
}

/* Table styling */
table {
    width: 100%; /* Full width table */
    border-collapse: collapse; /* Collapse borders */
    margin-top: 20px; /* Margin above the table */
}

table, th, td {
    border: 1px solid #ddd; /* Light border for table */
    padding: 10px; /* Padding for cells */
    text-align: left; /* Left align text */
}

/* Header cell styling */
th {
    background-color: #f2f2f2; /* Light grey background for headers */
    font-weight: bold; /* Bold text for headers */
}

/* Button link styling */
.btn-link {
    text-decoration: none; /* No underline for links */
    color: #0066cc; /* Blue color for links */
    font-weight: bold; /* Bold links */
}

.btn-link:hover {
    text-decoration: underline; /* Underline on hover */
}

/* Session message styling */
.session-message {
    background-color: #e0ffe0; /* Light green background */
    padding: 10px; /* Padding for message */
    margin-bottom: 20px; /* Margin below message */
    border: 1px solid #00b300; /* Darker green border */
    color: #006600; /* Dark green text */
    border-radius: 5px; /* Rounded corners for message box */
}

/* Responsive design */
@media (max-width: 768px) {
    .container {
        padding: 15px; /* Reduce padding on smaller screens */
    }

    table {
        font-size: 14px; /* Smaller font for tables */
    }

    th, td {
        padding: 12px; /* Adjust padding for table cells */
    }
}

@media (max-width: 480px) {
    .container {
        padding: 10px; /* Further reduce padding */
    }

    table {
        font-size: 12px; /* Smaller font for mobile */
    }

    th, td {
        padding: 8px; /* Adjust padding for table cells */
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Personalized Itinerary Planner</h1>

        <!-- Display session message if exists -->
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='session-message'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']); // Clear the message after displaying
        }

        // Display itinerary if set
        if (isset($_SESSION['itinerary'])) {
            echo "<h2>Your Itinerary:</h2><ul>";
            foreach ($_SESSION['itinerary'] as $step) {
                echo "<li>$step</li>";
            }
            echo "</ul>";
            unset($_SESSION['itinerary']); // Clear itinerary after displaying
        }
        ?>

        <h2>Available Rides and Services</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <?php
            // Check if there are any rows in the result
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td><a href='generate_itinerary.php?rideService=" . urlencode($row['name']) . "' class='btn-link'>Generate Itinerary</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No rides available</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
