<?php
// Database connection details
$servername = "localhost"; // Your database server
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "amusement_park"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//error handling implimented if the database connections fails it notify the user 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
