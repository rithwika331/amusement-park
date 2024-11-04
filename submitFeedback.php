<?php 
// Start session
session_start();

// Check if session is set to display feedback
if (isset($_SESSION['feedback'])) {
    echo "<div class='session-message'>".$_SESSION['feedback']."</div>";
    // Unset session feedback to avoid repeated alerts
    unset($_SESSION['feedback']);
}

// Check if there is an error message and display it
if (isset($_SESSION['error'])) {
    echo "<div class='error-message'>".$_SESSION['error']."</div>";
    // Unset error message
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amusement Park Feedback Form</title>
    <style type="styles.css"></style>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .session-message {
            background-color: #eafaf1;
            color: #317c41;
            padding: 10px;
            border-left: 5px solid #317c41;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .error-message {
            background-color: #fce4e4;
            color: #d32f2f;
            padding: 10px;
            border-left: 5px solid #d32f2f;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        form {
            max-width: 600px;
            height: auto;
            max-height: 400px;
            overflow-y: auto;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container {
            padding: 20px;
            max-width: 100%;
            background-color: #8CB3FC;
            border-radius: 10px;
            box-shadow: 0 4px 5px rgba(0, 0, 0, 0.1);
            width: 350px;
            margin: 10px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        textarea {
            height: 100px;
            resize: none;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 50%;
            display: block;
            margin: 0 auto;
            padding: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        @media (max-width: 480px) {
            .container {
                padding: 150px;
                box-shadow: none;
            }
            input, textarea, select, button {
                padding: 8px;
            }
            h2 {
                font-size: 18px;
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Share Your Feedback</h2>
        <form action="process_feedback.php" method="POST">
            <!-- Name -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">

            <!-- Date of Visit -->
            <label for="date">Date of Visit:</label>
            <input type="date" id="date" name="date" required>

            <!-- Feedback Comments -->
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" required placeholder="Share your thoughts..."></textarea>

            <!-- Rating -->
            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="">-- Select Rating --</option>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Good</option>
                <option value="3">3 - Average</option>
                <option value="2">2 - Poor</option>
                <option value="1">1 - Terrible</option>
            </select>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

</body>
</html>
