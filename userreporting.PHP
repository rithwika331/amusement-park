<?php   
// Include admin header and database connection
include 'adminheader.php';
include 'db_connect.php';
session_start(); // Start the session

// Fetch all users from the database for View Users report
$users_sql = "SELECT * FROM users";
$users_result = $conn->query($users_sql);
$total_users = $users_result->num_rows;

// Fetch specific columns from bookings for Manage Bookings report
$bookings_sql = "SELECT id, first_name, email, ride_service, user_id FROM bookings";
$bookings_result = $conn->query($bookings_sql);
$total_bookings = $bookings_result->num_rows;
?>

<div class="container">
    <h2>Admin Reports - Overview</h2>

    <!-- View Users Section -->
    <h3>View Users</h3>
    <p>Total Registered Users: <?= $total_users ?></p>

    <a href="view_users.php" class="btn btn-secondary">View All Users</a>

    <!-- Manage Bookings Section -->
    <h3>Manage Bookings</h3>
    <p>Total Bookings: <?= $total_bookings ?></p>

    <a href="view_bookings.php" class="btn btn-secondary">View All Bookings</a>
</div>

<?php include 'footer.php'; $conn->close(); ?>

<style>
    .container {
    width: 80%; /* Make it wide */
    max-width: 1500px; /* Limit width on larger screens */
    margin: 20px auto; /* Center container on the page */
    padding: 40px; /* Add spacing inside the container */
    background-color: #f9f9f9; /* Light background color */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}
    .btn-primary, .btn-secondary {
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        margin-top: 10px;
        display: inline-block;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .container h2, .container h3, .container p {
        text-align: center;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th, .custom-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .custom-table th {
        background-color: #f2f2f2;
    }

    .thead-dark th {
        background-color: #343a40;
        color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .custom-table th, .custom-table td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        .custom-table th {
            display: none;
        }

        .custom-table tr {
            margin-bottom: 15px;
        }

        .custom-table td {
            text-align: right;
            position: relative;
            padding-left: 50%;
        }

        .custom-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 10px;
            font-weight: bold;
            text-align: left;
        }
    }

    /* Print styles */
    @media print {
        .btn-primary, .btn-secondary {
            display: none;
        }
    }
</style>
