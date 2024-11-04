<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Park</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your external CSS -->
</head>
<style>
    


h1, h2 {
    color: #333;
    margin-bottom: 60px;
}



/* Image styles */
.park-image, .ride-image {
    width: 70%; /* Make images responsive */
    height: auto; /* Maintain aspect ratio */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 5px; /* Space below images */
}

/* Gallery styles */
.image-gallery {
    display: flex;
    flex-wrap: wrap; /* Allow images to wrap to the next line */
    justify-content: space-between; /* Space images evenly */
}

.ride-image {
    flex: 1 1 30%; /* Allow images to grow and shrink */
    margin: 5px; /* Space between images */
}

/* List styles */
ul {
    list-style-type: none; /* Remove default list styles */
    padding-left: 0; /* Remove padding */
}

li {
    margin-bottom: 10px; /* Space between list items */
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .content {
        padding: 10px; /* Reduce padding on smaller screens */
    }
    
    h1 {
        font-size: 1.8em; /* Slightly smaller font size for headings */
    }

    h2 {
        font-size: 1.5em; /* Slightly smaller font size for subheadings */
    }

    .image-gallery {
        flex-direction: column; /* Stack images vertically on small screens */
    }

    .ride-image {
        flex: 1 1 100%; /* Full width for images */
        margin: 10px 0; /* Space above and below images */
    }
}

/* Additional styles for accessibility and usability */
p {
    margin-bottom: 15px; /* Space between paragraphs */
    color: #555; /* Slightly darker text for readability */
}


</style>
<body>
    <!-- PHP include for header -->
    <?php include 'header2.php'; ?>

    <div class="content">
        <h1>Water Park</h1>
        <img src="images/waterpark1.jpg" alt="Water Park Overview" class="park-image" aria-label="Water Park overview with slides and pools">

        <h2>Overview</h2>
        <p>Cool off and splash around in our state-of-the-art water park, suitable for all ages! Whether you're seeking thrilling water slides, a relaxing lazy river, or a fun splash zone for the little ones, our water park has it all.</p>

        <h2>Features</h2>
        <ul>
            <li><strong>Thrill Rides:</strong> High-speed water slides for adrenaline junkies, including the <em>Tidal Wave</em> and <em>Plunge of Doom</em>.</li>
            <li><strong>Wave Pool:</strong> A gigantic wave pool perfect for swimming, floating, and riding waves up to 6 feet tall.</li>
            <li><strong>Lazy River:</strong> Drift lazily down our winding river for the ultimate relaxation.</li>
            <li><strong>Kids' Splash Zone:</strong> An interactive area designed for younger children with fountains, smaller slides, and water toys.</li>
            <li><strong>Cabanas:</strong> Rent private, shaded cabanas for a comfortable space to relax between water adventures.</li>
        </ul>

        <h2>Gallery</h2>
        <div class="image-gallery">
            <img src="images/waterslide2.avif" alt="Thrilling Water Slide" class="ride-image" aria-label="Thrilling water slide">
            <img src="images/wavepool.jpeg" alt="Wave Pool" class="ride-image" aria-label="Wave pool with waves">
            <img src="images/kidssplash.jpeg" alt="Kids' Splash Zone" class="ride-image" aria-label="Interactive splash zone for kids">
        </div>

        <h2>Safety Information</h2>
        <p>Safety is our top priority! Lifeguards are stationed throughout the water park, and all rides have strict safety guidelines. Please adhere to height and weight restrictions, and follow lifeguard instructions at all times.</p>

        <h2>Park Hours</h2>
        <p>The Water Park is open daily from 9:00 AM to 8:00 PM. We recommend arriving early for prime seating and shorter wait times for rides.</p>
    </div>

    <!-- PHP include for footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
