<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'bella_coffee'; // Replace with your DB name
$user = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL; // Get user ID from session or set as NULL

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare the SQL statement
        $sql = "INSERT INTO messages (user_id, message, status, created_at) VALUES (:user_id, :message, 'new', NOW())";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            // Set success message and redirect back to the contact page
            $_SESSION['success'] = "Your message has been sent successfully!";
            header("Location: contact.php");
            exit;
        } catch (PDOException $e) {
            // Log the error and redirect with error message
            $_SESSION['error'] = "Failed to send your message. Please try again.";
            error_log("Database Error: " . $e->getMessage());
            header("Location: contact.php");
            exit;
        }
    } else {
        // Validation error
        $_SESSION['error'] = "All fields are required.";
        header("Location: contact.php");
        exit;
    }
} else {
    // Redirect if accessed directly
    header("Location: contact.php");
    exit;
}
?>