<?php 
// Include admin header and database connection
include 'adminheader.php';
include 'db_connect.php';
session_start(); // Start the session

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM feedback WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Feedback deleted successfully.";
        $stmt->close();
        header("Location: admindashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error deleting feedback.";
    }
    $stmt->close();
}

// Fetch all feedback records from the database
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

// Generate report summary
$total_feedback = $result->num_rows;
$rating_sql = "SELECT AVG(rating) as avg_rating FROM feedback";
$rating_result = $conn->query($rating_sql);
$avg_rating = ($rating_result->num_rows > 0) ? round($rating_result->fetch_assoc()['avg_rating'], 2) : 'N/A';

// Initialize an array for rating counts (1 to 5 stars)
$rating_counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

// Fetch rating distribution from the database
$rating_distribution_sql = "SELECT rating, COUNT(*) as count FROM feedback GROUP BY rating";
$distribution_result = $conn->query($rating_distribution_sql);

if ($distribution_result->num_rows > 0) {
    while ($row = $distribution_result->fetch_assoc()) {
        $rating_counts[intval($row['rating'])] = intval($row['count']);
    }
}
?>

<div class="container">
    <h2>View User Feedback</h2>

    <button onclick="window.print()" class="btn btn-primary">Print Report</button> <!-- Print button -->

    <?php if (isset($_SESSION['success_message'])) { ?>
        <div class='alert custom-alert'><?= $_SESSION['success_message'] ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php } elseif (isset($_SESSION['error_message'])) { ?>
        <div class='alert custom-alert'><?= $_SESSION['error_message']; ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php } ?>

    <div class="table-responsive">
        <table class="table table-bordered custom-table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Visit</th>
                    <th>Comments</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='ID'>" . $row['id'] . "</td>";
                        echo "<td data-label='Name'>" . $row['name'] . "</td>";
                        echo "<td data-label='Email'>" . $row['email'] . "</td>";
                        echo "<td data-label='Date of Visit'>" . $row['visit_date'] . "</td>";
                        echo "<td data-label='Comments'>" . $row['comments'] . "</td>";
                        echo "<td data-label='Rating'>" . $row['rating'] . "</td>";
                        echo "<td data-label='Actions'><a href='viewfeedback.php?delete_id=" . $row['id'] . "' class='btn btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No feedback found.</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>

    <h3>Feedback Summary Report</h3>
    <p>Total Feedback Records: <?= $total_feedback ?></p>
    <p>Average Rating: <?= $avg_rating ?></p>

    <div class="graph-container">
        <h3>Feedback Rating Distribution</h3>
        <div class="graph">
            <?php foreach ($rating_counts as $rating => $count): ?>
                <div class="bar-container">
                    <div class="bar" style="height: <?= $count * 20 ?>px;">
                        <?= $count ?>
                    </div>
                    <div class="label"><?= $rating ?> Star</div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; $conn->close(); ?>

<style>
    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    nav {
        display: flex;
        justify-content: flex-end;
        padding: 15px;
        box-sizing: border-box;
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
    }

    nav ul li {
        margin-left: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: #90EE90;
        padding: 10px 15px;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .custom-alert {
        margin-top: 10px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        color: #d9534f;
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

    .graph-container {
        margin-top: 20px;
        text-align: center;
    }

    .graph {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        margin-top: 10px;
        overflow-x: auto; /* Allow horizontal scrolling */
    }

    .bar-container {
        margin: 0 10px;
        text-align: center;
    }

    .bar {
        width: 40px;
        background-color: #007bff;
        color: #fff;
        font-size: 14px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        padding-bottom: 5px;
        border-radius: 5px 5px 0 0;
    }

    .label {
        margin-top: 5px;
        font-weight: bold;
    }

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

        .graph {
            flex-direction: row;
            overflow-x: auto; /* Enable horizontal scroll if needed */
        }

        .bar {
            width: 40px; /* Maintain bar width */
            min-height: 20px; /* Set a minimum height */
        }
    }

    @media print {
        nav, .btn-primary, .custom-alert {
            display: none;
        }

        .table-responsive {
            display: block;
        }

        .custom-table {
            width: 100%;
            border: 1px solid #000;
        }

        .custom-table th, .custom-table td {
            font-size: 12pt;
        }

        .graph {
            flex-direction: row;
            align-items: flex-end;
        }

        .bar {
            width: 40px; /* Ensure bars maintain their width */
            height: auto; /* Adjust height automatically based on content */
            background-color: #007bff !important; /* Ensure bar color is preserved when printing */
        }

        .label {
            color: #000; /* Change label color to black for print */
        }
    }
</style>



 