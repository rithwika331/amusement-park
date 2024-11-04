<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Accessible Amusement Park</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="images/logo.png" alt="Accessible Amusement Park Logo" class="logo">
            <h1>Reset Your Password</h1>
        </div>
    </header>

    <main>
        <section>
            <h2>Enter a New Password</h2>
            <form action="process_reset_password.php" method="POST">
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Reset Password</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Accessible Amusement Park. All rights reserved.</p>
    </footer>
</body>
</html>
