<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Experience</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }

        /* Container for Centered Content */
        .content-container {
            max-width: 400px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
        }

        /* Title and Description */
        .share-title {
            font-size: 1.4em;
            color: #333;
            margin-bottom: 10px;
        }

        .share-description {
            font-size: 1em;
            color: #555;
            margin-bottom: 20px;
        }

        /* Image Styling */
        .share-image {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        /* Social Media Buttons */
        .social-button {
            width: 50px;
            height: 50px;
            margin: 0 5px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2em;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        /* Social Media Colors */
        .facebook { background-color: #3b5998; }
        .twitter { background-color: #1da1f2; }
        .instagram { background-color: #e1306c; }

        /* Hover Effect */
        .social-button:hover {
            transform: scale(1.1);
        }

        /* Mobile Responsiveness */
        @media (max-width: 400px) {
            .social-button {
                width: 40px;
                height: 40px;
                font-size: 1em;
                margin: 0 3px;
            }
            .share-title {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>

    <div class="content-container">
        <!-- Header Section with Image -->
        <h2 class="share-title">Share Your Amazing Park Experience!</h2>
        <p class="share-description">Show your friends and family the fun you had at the amusement park. Don’t forget to tag us!</p>
        <img src="images/shareto.jpeg" alt="Park Experience" class="share-image">

        <!-- Social Media Links -->
        <div>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://youramusementpark.com" 
               target="_blank" 
               class="social-button facebook" 
               title="Share on Facebook">
                F
            </a>

            <a href="https://twitter.com/intent/tweet?text=Check out this amazing park!&url=https://youramusementpark.com" 
               target="_blank" 
               class="social-button twitter" 
               title="Share on Twitter">
                T
            </a>

            <a href="https://www.instagram.com/" 
               target="_blank" 
               class="social-button instagram" 
               title="Share on Instagram">
                I
            </a>
        </div>
    </div>

</body>
</html>
