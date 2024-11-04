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
        $_SESSION['success_message'] = "Feedback deleted successfully."; // Set success message
        $stmt->close();
        header("Location: admindashboard.php"); // Redirect to feedback page after deleting
        exit(); // Ensure no further code is executed
    } else {
        $_SESSION['error_message'] = "Error deleting feedback."; // Set error message
    }
    $stmt->close();
}

// Fetch all feedback records from the database
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
?>

<div class="container">
    <h2>View User Feedback</h2>

    <!-- Display success or error messages at the top -->
    <?php
    if (isset($_SESSION['success_message'])) {
        echo "<div class='alert custom-alert'>" . $_SESSION['success_message'] . "</div>";
        unset($_SESSION['success_message']); // Clear the message after displaying
    }
    if (isset($_SESSION['error_message'])) {
        echo "<div class='alert custom-alert'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']); // Clear the message after displaying
    }
    ?>

    <!-- Display the table of feedback -->
    <div class="table-responsive"> <!-- Ensure the table is responsive -->
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
                <?php
                // Check if feedback records exist in the database
                if ($result->num_rows > 0) {
                    // Loop through each feedback and display it in the table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['visit_date'] . "</td>";
                        echo "<td>" . $row['comments'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>
                                <a href='viewFeedback.php?delete_id=" . $row['id'] . "' class='btn btn-sm' onclick=\"return confirm('Are you sure you want to delete this feedback?');\">Delete</a> <!-- Delete Button -->
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No feedback found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Include admin footer
include 'footer.php';
$conn->close();
?>

<!-- Additional CSS for styling and responsiveness -->
<style>
    /* General container styling */
.container {
    margin-top: 20px;
    padding: 0 15px; /* Adds padding for smaller screens */
    max-width: 100%; /* Ensures full width utilization */
}

/* Table styling */
.custom-table {
    border: 2px solid #333;
    border-radius: 8px;
    margin-top: 20px;
    background-color: #F5F7FA;
    width: 100%; /* Makes table use the full width */
}

.custom-table th, .custom-table td {
    border: 1px solid #333;
    padding: 8px;
    text-align: left;
}

.custom-table th {
    background-color: #0B244D;
    color: white;
}

/* Responsive table - wraps content for smaller screens */
.table-responsive {
    overflow-x: auto; /* Allows horizontal scroll */
}

@media (max-width: 768px) {
    /* Ensures that content doesn’t shrink excessively on smaller screens */
    .custom-table th, .custom-table td {
        display: block;
        width: 100%;
        font-size: 1rem; /* Increases font size for readability */
    }

    /* Prepend header labels in each cell for easier viewing */
    .custom-table td::before {
        content: attr(data-label); /* Displays data-label content */
        font-weight: bold;
        display: inline-block;
        width: 40%; /* Occupies 40% of each cell */
        padding-right: 10px;
    }

    /* Custom font size and padding adjustments */
    h2 {
        font-size: 1.5rem; /* Larger font for mobile headers */
    }

    .custom-table {
        font-size: 0.95rem; /* Slightly smaller font for compactness */
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 0.8rem;
    }
}

/* Alert box styling */
.custom-alert {
    background-color: #E53835;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
    text-align: center;
    font-weight: bold;
    font-size: 1.1rem; /* Larger font for emphasis */
}

/* General adjustments to improve mobile experience */
@media (max-width: 576px) {
    .container {
        padding: 0 10px;
    }

    h2 {
        font-size: 1.4rem;
    }

    .custom-table {
        font-size: 0.9rem;
    }

    .custom-alert {
        font-size: 1rem; /* Adjusted alert font size */
        padding: 8px;
    }

    .btn-sm {
        width: 100%;
        padding: 8px 0; /* Full-width buttons on small screens */
    }
}

</style>



