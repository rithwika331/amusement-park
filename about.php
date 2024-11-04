<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessible Amusement Park - About Us</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            min-height: 100vh; /* Ensures body takes full height */
        }

        /* Header */
        header {
            background-color: #2194f3;
            padding: 1px 0;
            color: white;
            text-align: center;
            position: fixed; /* Fixes the header at the top */
            top: 0; /* Positions it at the top of the page */
            width: 100%; /* Ensures the header spans the full width */
            z-index: 1000; /* Ensures it stays above other content */
        }

        header h1 {
            font-size: 1.8rem;
        }

        nav {
            padding-bottom: 15px;
        }

        /* Navigation List */
        nav ul {
            display: flex;
            justify-content: space-between; /* Spreads items between left and right */
            width: 100%; /* Ensures the nav items take the full width */
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: lightgreen; /* Ensure sufficient contrast */
            text-decoration: none;
            font-weight: bold;
            padding: 10px 45px;
            font-size: 1.5em; /* Increase font size for better visibility */
        }

        nav ul li a:hover {
            outline: 2px solid #000; /* Add visible focus outline for accessibility */
            background-color: #f0f0f0; /* Background color on focus and hover */
        }

        /* Main Content */
        main {
            padding: 150px;
            text-align: center;
            flex: 1; /* Makes the main content expand and push the footer down */
            margin-top: 140;
        }


        .image-gallery {
            margin: 20px 0;
        }

        .scroll-container {
            display: flex;
            overflow: hidden; /* Hide the overflow */
            width: 100%;
            position: relative;
            height: 220px; /* Adjust based on image height */
        }

        .scroll-content {
            display: flex;
            position: absolute;
            white-space: nowrap;
            animation: scroll 20s linear infinite; /* Animation for continuous scroll */
        }

        .scroll-content img {
            width: 300px;
            height: 200px;
            margin-right: 15px;
            border-radius: 5px;
            object-fit: cover;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        @keyframes scroll {
            0% {
                transform: translateX(100%); /* Start from the right */
            }
            100% {
                transform: translateX(-100%); /* Move to the left */
            }
        }

        /* Logo container */
        .logo-container {
            display: flex;
            align-items: center;
        }

        /* Logo styling */
        .logo {
            width: 100px; /* Adjust size as needed */
            height: 75px;
            border-radius: 50%; /* Oval shape */
            object-fit: cover; /* Ensure the logo maintains its aspect ratio */
            margin-right: 20px; /* Space between logo and text */
        }

        /* Welcome text */
        .welcome-text {
            display: inline-block; /* Ensure the text stays on the same line */
            white-space: nowrap; /* Prevent wrapping */
            animation: slide 15s linear infinite; /* Adjust duration as needed */
        }
        .about-park h2 {
    font-family: 'Arial', sans-serif;
    font-size: 28px;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
  }
  
  .about-park p {
    font-family: 'Verdana', sans-serif;
    font-size: 16px;
    color: #34495e;
    line-height: 1.6;
    text-align: justify;
    margin-bottom: 15px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
  }


        /* Footer */
        footer {
            background-color: #E1E5F6;
            color: #333333;
            text-align: center;
            padding: 20px 0;
            position: relative; /* Removed absolute positioning */
            bottom: 0;
            left: 0;
            width: 100%;
        }
        
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="images/logo.png" alt="Accessible Amusement Park Logo" class="logo">
            <h1>Accessible Amusement Park</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main class="custom-main">
    <div class="about-park">
        <h2>About Our Park</h2>
        <p>At Accessible Amusement Park, we believe in creating an inclusive environment where everyone can enjoy a fun and safe experience. Our park is designed with accessibility in mind, offering special accommodations for visitors of all abilities, including wheelchair-friendly paths, sensory-friendly spaces, and more.</p>
        <p>Our attractions are tailored to ensure accessibility without compromising the excitement and enjoyment that we offer. Come and explore all that we have to offer!</p>
    </div>

    <!-- Scrollable Image Gallery (Right to Left) -->
    <section class="image-gallery">
        <h3>Our Attractions</h3>
        <div class="scroll-container">
            <div class="scroll-content">
                <img src="images/ride1.jpg" alt="Accessible Roller Coaster">
                <img src="images/ride2.jpg" alt="Family-friendly Ferris Wheel">
                <img src="images/ride3.jpg" alt="Water Ride">
                <img src="images/ride4.jpg" alt="Sensory Room">
                <img src="images/ride5.jpg" alt="Live Entertainment Show">
            </div>
        </div>
    </section>
</main>
    <footer>
        <p>&copy; 2024 Accessible Amusement Park. All rights reserved.</p>
    </footer>
</body>
</html>
