<!-- header.php -->
<header>
    <div class="logo-container">
        <img src="images/logo.png" alt="Accessible Amusement Park Logo" class="logo">
        <h1>Welcome to the Accessible Amusement Park</h1>
    </div>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Log Out</a></li>
            <!-- Profile Icon Link with User Label -->
            <li class="profile-icon">
                <a href="profile.php" style="display: flex; align-items: center;">
                    <img src="images/user.jpg" alt="User Profile" class="user-icon">
                    <span class="user-label">User</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Styling -->
    <style>
        /* Header styling */
        header {
            position: fixed;
            top: 0;
            width: 100%;
           
        }

        /* Logo and title styling */
        .logo-container {
            display: flex;
            align-items: center;
            padding: 10px;
            text-align: center;
        }

        .logo-container img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        .logo-container h1 {
            font-size: 20px;
            color: #FFFFFF;
            margin: 0;
        }

        /* Navigation bar styling */
nav {
    display: flex;
    justify-content: flex-end; /* Aligns items to the right */
    padding: 15px;
    box-sizing: border-box;
}

/* Navigation list styling */
nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    width: 100%;
    flex-wrap: wrap; /* Allows items to wrap to the next line if needed */
}

/* List items spacing */
nav ul li {
    margin-left: 20px; /* Space between items */
}

/* Link styling */
nav ul li a {
    text-decoration: none;
    color: #90EE90;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    nav {
        justify-content: center; /* Center navigation on smaller screens */
    }

    nav ul {
        flex-direction: column; /* Stack items vertically */
        align-items: center; /* Center items in the column layout */
    }

    nav ul li {
        margin-left: 0; /* Remove left margin for stacked layout */
        margin-bottom: 10px; /* Space between stacked items */
    }

    nav ul li a {
        font-size: 14px; /* Slightly smaller font size on mobile */
        padding: 8px 12px; /* Adjust padding for mobile */
    }
}

@media (max-width: 480px) {
    nav ul li {
        margin-bottom: 5px; /* Less space between items on very small screens */
    }

    nav ul li a {
        font-size: 12px; /* Further reduce font size */
        padding: 6px 10px; /* Adjust padding for very small screens */
    }
}

        /* Profile icon alignment */
        .profile-icon {
            margin-left: auto;
        }

        /* User icon styling */
        .user-icon {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

        /* User label styling */
        .user-label {
            font-size: 16px;
            color: #90EE90;
        }

        /* Responsive styling for mobile screens */
        @media (max-width: 768px) {
            /* Logo container adjustments */
            .logo-container {
                flex-direction: column;
                padding: 10px;
            }

            .logo-container img {
                width: 40px;
            }

            .logo-container h1 {
                font-size: 18px;
                margin-top: 5px;
            }

            /* Navigation adjustments */
            nav {
                padding: 10px;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin-left: 0;
                margin-bottom: 10px;
            }

            nav ul li a {
                padding: 8px 10px;
                font-size: 14px;
            }

            /* Profile icon adjustments */
            .profile-icon {
                margin-left: 0;
            }

            .user-icon {
                width: 18px;
                height: 18px;
            }

            .user-label {
                font-size: 14px;
            }
        }
    </style>
</header>

<!-- Add margin to the top of the main content so it isn't hidden behind the fixed header -->
<div style="margin-top: 80px;"></div>
