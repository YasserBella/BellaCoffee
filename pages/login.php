<?php
// Start session for tracking user
session_start();

// Include the database connection
require_once '../includes/db_connection.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to find the user by username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // In login.php, after user authentication
            $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the primary key
            $_SESSION['username'] = $user['username']; // Store the username
            $_SESSION['email'] = $user['email']; // Store the email


            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that username.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BellaCoffee - Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>

    <!-- Header Section -->
    <?php include('../includes/header.php'); ?>

    <!-- Login Form Section -->
    <section class="login-form">
        <div class="container">
            <h2>Login to Your Account</h2>
            <?php if (isset($error)) { echo '<p class="error">' . $error . '</p>'; } ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>&copy; 2024 BellaCoffee. All rights reserved.</p>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </footer>

</body>
</html>
