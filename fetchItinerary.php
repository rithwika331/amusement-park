<?php 
// Start the session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the rideService is set in the URL parameters
$rideService = isset($_GET['rideService']) ? $_GET['rideService'] : '';

if (!$rideService) {
    echo "<li>No ride or service selected.</li>";
    exit;
}

// Generate the itinerary based on the selected ride/service
$itinerary = [
    "Arrive at the park and enjoy the {$rideService}.",
    "Take a break after the {$rideService}.",
    "Explore other attractions before lunchtime.",
    "Enjoy a meal at the park's café.",
    "Continue with more rides or activities!"
];

// Output the itinerary as HTML list items
foreach ($itinerary as $step) {
    echo "<li>" . htmlspecialchars($step) . "</li>";
}
?>
