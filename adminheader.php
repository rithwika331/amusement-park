<!-- header.php -->
<header>
    <div class="logo-container">
        <img src="images/logo.png" alt="Accessible Amusement Park Logo" class="logo">
        <h1>Welcome to the Accessible Amusement Park</h1>
        <style>
            
            /* Ensure the nav and its elements are aligned */
nav {
  
    display: flex;
    justify-content: flex-end; /* Aligns items to the right */
   ; /* Optional: Add a background color */
    padding: 15px;
    box-sizing: border-box; /* Include padding in width */
}

/* Style the list to align horizontally */
nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center; /* Vertically center the items */
}

/* List items spacing */
nav ul li {
    margin-left: 20px;
}

/* Links styling */
nav ul li a {
    text-decoration: none;
    color: #90EE90;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}
        </style>


    </div>
    <nav>
        <ul>
            <li><a href="admindashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Log Out</a></li> <!-- Log Out link -->
        </ul>
    </nav>
</header>
