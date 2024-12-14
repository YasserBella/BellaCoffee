<?php
// Start a session to track user data
session_start();

// Include database connection
require_once '../includes/db_connection.php'; // Make sure the path is correct

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful! You can now log in.";
        header("Location: login.php");
        exit;
    } else {
        $error = "An error occurred. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BellaCoffee</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1><a href="/">BellaCoffee</a></h1>
        </div>
    </header>

    <!-- Registration Form -->
    <section class="register">
        <div class="container">
            <h2>Create Your Account</h2>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" class="btn">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 BellaCoffee. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
