<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Accessible Amusement Park</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="images/logo.png" alt="Accessible Amusement Park Logo" class="logo">
            <h1>Forgot Your Password?</h1>
        </div>
    </header>

    <main>
        <section>
            <h2>Reset Your Password</h2>
            <form action="process_forgot_password.php" method="POST">
                <label for="email">Enter your email address:</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">Send Reset Link</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Accessible Amusement Park. All rights reserved.</p>
    </footer>
</body>
</html>
