<?php 
// accessInfo.php

// Styling each section with a more readable, appealing format
echo '<style>
    .access-info {
        background-color: #f9f9f9; /* Light background for contrast */
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .access-info h2 {
        color: #0056b3; /* Darker blue for main headings */
        margin-bottom: 10px;
        font-size: 1.8em; /* Increased font size for headings */
    }
    
    .access-info h3 {
        color: #007BFF; /* Primary color for subheadings */
        margin-bottom: 8px;
        font-size: 1.5em; /* Font size for subheadings */
    }
    
    .access-info p {
        color: #333; /* Darker text color for readability */
        font-size: 1.2em; /* Slightly larger font size for paragraphs */
        line-height: 1.6; /* Improved line height for readability */
        margin-bottom: 15px;
    }
    
    .access-info ul {
        padding-left: 0; /* Remove padding for list */
        color: #333; /* Darker text for list items */
        list-style-type: none; /* Remove bullet points */
    }
    
    .access-info li {
        margin-bottom: 8px;
        font-size: 1.1em; /* Font size for list items */
    }
    
    .access-info a {
        color: #007BFF; /* Link color */
        text-decoration: none; /* No underline for links */
        font-weight: bold; /* Bold links */
    }

    .access-info a:hover {
        text-decoration: underline; /* Underline on hover for links */
    }
</style>';

echo '<div class="access-info">';

    // Header Section
    echo '<h2>Accessibility Information</h2>';
    echo '<p>Welcome to our amusement park! We are committed to providing an inclusive experience for all our guests. Below are some key accessibility features available at our park:</p>';

    // Accessibility Features Section
    echo '<h3>Accessibility Features</h3>';
    echo '<ul>';
        echo '<li>Wheelchair-accessible entrances and pathways</li>';
        echo '<li>Accessible restrooms located throughout the park</li>';
        echo '<li>Rental services for wheelchairs and mobility scooters</li>';
        echo '<li>Accessible ride options available</li>';
        echo '<li>Trained staff available to assist guests with disabilities</li>';
        echo '<li>Visual and auditory aids available for guests with hearing and vision impairments</li>';
    echo '</ul>';

    // Additional Resources Section
    echo '<h3>Additional Resources</h3>';
    echo '<p>If you have specific needs or questions regarding accessibility, please do not hesitate to contact our guest services team at <strong>123-456-7890</strong>.</p>';

echo '</div>';
?>
