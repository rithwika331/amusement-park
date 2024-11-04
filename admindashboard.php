<!DOCTYPE html>   
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // JavaScript function to load content based on button clicked
        function loadContent(page) {
            const contentSection = document.getElementById('contentSection');
            const dashboard = document.querySelector('.dashboard');

            // Hide the dashboard when a button is clicked on mobile view
            if (window.innerWidth <= 768) {
                dashboard.style.display = 'none';
            }

            // Smooth scroll to content section
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });

            const xhr = new XMLHttpRequest();
            xhr.open('GET', page + '.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    // Wrap the content with header and footer
                    contentSection.innerHTML = `
                        <?php include 'adminheader.php'; ?>
                        <div class="dynamic-content">
                            ${this.responseText}
                        </div>
                        <?php include 'footer.php'; ?>
                    `;
                } else {
                    contentSection.innerHTML = '<p>Error loading content. Please try again.</p>';
                }
            };
            xhr.send();
        }
    </script>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
    /* Ensure the navigation takes up full width */
    display: flex;
    justify-content: flex-end; /* Align items to the right */
     /* Optional: Add a background color */
    padding: 5px; /* Add padding for spacing */
}

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #0163F6;
            color: white;
            padding: 10px 20px;
            z-index: 1000; /* Ensure the header is above other content */
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
    padding: 1px 0;
    color: white;
    text-align: center;
    color: white;
    text-align: center;
    position: fixed; /* Fixes the header at the top */
    top: 10; /* Positions it at the top of the page */
    width: 100%; /* Ensures the header spans the full width */
    z-index: 1000; /* Ensures it stays above other content */

        }

        /* Add responsiveness */
        @media (max-width: 600px) {
            header {
                padding: 10px; /* Reduce padding for smaller screens */
                flex-direction: column; /* Stack items vertically */
                align-items: flex-start; /* Align items to the start */
            }

            .logo {
                margin-bottom: 10px; /* Space below the logo */
            }

            .nav-links {
                width: 100%; /* Make navigation links full-width */
                display: flex; /* Use flex for horizontal alignment */
                justify-content: space-between; /* Space links evenly */
                flex-wrap: wrap; /* Wrap links if needed */
            }

            .nav-link {
                flex: 1 1 auto; /* Allow links to grow/shrink */
                text-align: center; /* Center links */
                padding: 5px 0; /* Add vertical padding to links */
            }
        }

        .dashboard {
            width: 150px; /* Fixed width */
            position: fixed; /* Keeps it fixed on the screen */
            top: 160px; /* Ensure this is below the header, adjusted for header height */
            left: 0; /* Fix to the left side */
            bottom: 0; /* Keep it to the bottom */
            background-color: #f1f1f1; /* Optional: Add background color */
            z-index: 1000; /* Ensure it stays above other elements */
            overflow-y: auto; /* If the content is too large, make it scrollable */
            padding: 80px; /* Adjust padding */
        }

        main {
            margin-left: 180px; /* Leave space for the dashboard on larger screens */
            padding-top: 50px; /* Add padding to prevent content from going under the header */
        }

        .content {
            padding: 20px;
        }

        footer { 
            position: fixed;
            bottom: 0; /* Aligns it to the bottom of the viewport */
            left: 0; /* Aligns it to the left edge */
            width: 100%; /* Makes the footer take the full width */
            background-color: #e0e7ff; /* Set your background color */
            text-align: center; /* Centers the text */
            padding: 5px 0; /* Adds padding for spacing */
            z-index: 1000; /* Keeps it above other content */
        }

        /* Responsive styles for mobile view */
        @media (max-width: 768px) {
            footer {
                font-size: 0.9em; /* Slightly smaller text size for mobile */
                padding: 10px 0; /* Increase padding for better spacing */
            }
        }

        /* Remove bullets from the dashboard */
        .dashboard ul {
            list-style-type: none; /* Removes bullets */
            padding: 0; /* Removes default padding */
            margin: 0; /* Removes default margin */
        }

        .dashboard ul li {
            margin-bottom: 10px; /* Adds space between buttons */
        }

        .dashboard button {
            width: 100%; /* Make buttons full width for better accessibility */
            padding: 10px; /* Padding for buttons */
            font-size: 16px; /* Increase font size for readability */
            background-color: #007BFF; /* Button color */
            color: white; /* Button text color */
            border: none; /* Remove default button border */
            border-radius: 5px; /* Rounded corners for buttons */
            cursor: pointer; /* Pointer cursor on hover */
            margin-top: 10px; /* Add margin above each button */
        }

        .dashboard button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            header {
                flex-direction: column; /* Stack header items on small screens */
            }

            main {
                margin-left: 0; /* Remove left margin for smaller screens */
                padding-top: 60px; /* Adjust top padding */
            }

            .flex-container {
                flex-direction: column; /* Stack dashboard and content vertically */
                margin: 0; /* Remove default margin */
                padding: 0; /* Remove default padding */
            }

            .dashboard {
                position: relative; /* Change to relative so it flows with the content */
                width: 100%; /* Full width dashboard */
                margin-top: 10px; /* Increased space above dashboard */
                padding: 20px; /* Adjust padding */
                top: 0; /* Reset top position */
                left: 0; /* Align it to the left */
                display: block; /* Ensure dashboard is displayed on mobile */
            }

            .dashboard.hidden {
                display: none; /* Hide dashboard on mobile when the button is clicked */
            }

            .content {
                width: 100%; /* Make content take up full width */
                padding-top: 20px; /* Add space above content */
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 20px; /* Smaller header text */
            }

            .dashboard button {
                font-size: 14px; /* Smaller button text */
                margin-top: 15px; /* Increased space between buttons */
            }

            main {
                padding-top: 60px; /* Adjust padding for small screens */
            }
        }
    </style>
</head>
<body>
    <?php include 'adminheader.php'; ?> <!-- Include the header -->

    <main>
        <div class="flex-container">
            <!-- Left side: Admin dashboard -->
            <aside class="dashboard">
                <h2>Admin Dashboard</h2>
                <ul>
                    <li><button onclick="loadContent('viewUsers')">View Registered Users</button></li>
                    <li><button onclick="loadContent('manageBookingInformation')">Manage User Bookings</button></li>
                    <li><button onclick="loadContent('viewFeedback')">View User Feedback</button></li>
                    <li><button onclick="loadContent('manageque')">Manage Virtual Ques</button></li>
                    <li><button onclick="loadContent('notifications')">Send Notifications</button></li>
                    <li><button onclick="loadContent('reporting')">Generate Feedback Reports</button></li>
                    <li><button onclick="loadContent('userreporting')">Generate user and manage booking Reports</button></li>
                </ul>
            </aside>

            <!-- Right side: Dynamic content area -->
            <section class="content" id="contentSection">
                <p>Welcome to the Admin Management System! Click on the options to manage users, bookings, and more.</p>
            </section>
        </div>
    </main>

    <?php include 'footer.php'; ?> <!-- Include the footer -->
</body>
</html>
