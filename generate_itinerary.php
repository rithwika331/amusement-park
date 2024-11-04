<?php
// Start the session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the rideService is set in the URL parameters
$rideService = isset($_GET['rideService']) ? $_GET['rideService'] : '';

if (!$rideService) {
    echo "No ride or service selected.";
    exit;
}

// Generate the itinerary based on the selected ride/service
$_SESSION['itinerary'] = [
    "Arrive at the park and enjoy the {$rideService}.",
    "Take a break after the {$rideService}.",
    "Explore other attractions before lunchtime.",
    "Enjoy a meal at the park's café.",
    "Continue with more rides or activities!"
];

// Store a success message in the session
$_SESSION['message'] = "Itinerary generated successfully for {$rideService}.";

// Redirect back to personalItinerary.php
header("Location: dashboard.php");
exit;
?>
