<?php
// Start session to access user data
session_start();

// Include the database connection file
require_once '../includes/db_connection.php';

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    header("Location: login.php");
    exit;
}

// Fetch statistics for the logged-in user
$pending_orders_query = $conn->prepare("SELECT COUNT(*) as pending_count FROM orders WHERE user_id = ? AND status = 'pending'");
$pending_orders_query->bind_param("i", $user_id);
$pending_orders_query->execute();
$pending_orders_result = $pending_orders_query->get_result();
$pending_orders_count = $pending_orders_result->fetch_assoc()['pending_count'];

$total_orders_query = $conn->prepare("SELECT COUNT(*) as total_count FROM orders WHERE user_id = ?");
$total_orders_query->bind_param("i", $user_id);
$total_orders_query->execute();
$total_orders_result = $total_orders_query->get_result();
$total_orders_count = $total_orders_result->fetch_assoc()['total_count'];

$completed_orders_query = $conn->prepare("SELECT COUNT(*) as completed_count FROM orders WHERE user_id = ? AND status = 'completed'");
$completed_orders_query->bind_param("i", $user_id);
$completed_orders_query->execute();
$completed_orders_result = $completed_orders_query->get_result();
$completed_orders_count = $completed_orders_result->fetch_assoc()['completed_count'];

// Close the queries
$pending_orders_query->close();
$total_orders_query->close();
$completed_orders_query->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BellaCoffee</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <h1><a href="index.php">BellaCoffee</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="../pages/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Dashboard Content -->
    <section class="dashboard">
        <div class="container">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>Your exclusive BellaCoffee dashboard gives you access to manage your account, explore orders, and discover new offers.</p>

            <!-- Dashboard Features -->
            <div class="dashboard-features">
                <div class="feature-box">
                    <h3>Latest Offers</h3>
                    <p>Exclusive discounts on seasonal coffees!</p>
                    <a href="#" class="btn">View Offers</a>
                </div>
                <div class="feature-box">
                    <h3>Recent Orders</h3>
                    <p>Track the status of your latest orders.</p>
                    <a href="#" class="btn">View Orders</a>
                </div>
                <div class="feature-box">
                    <h3>Profile Settings</h3>
                    <p>Update your account details and preferences.</p>
                    <a href="#" class="btn">Edit Profile</a>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="stats">
                <div class="stat-box">
                    <h3>Pending Orders</h3>
                    <p><?php echo $pending_orders_count; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Total Orders</h3>
                    <p><?php echo $total_orders_count; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Completed Orders</h3>
                    <p><?php echo $completed_orders_count; ?></p>
                </div>
            </div>

            <!-- News Section -->
            <div class="news">
                <h3>BellaCoffee News</h3>
                <ul>
                    <li><strong>New Arrival:</strong> Moroccan Mint Coffee now available!</li>
                    <li><strong>Opening Hours:</strong> Extended hours for the holiday season.</li>
                    <li><strong>Community:</strong> Join our BellaCoffee rewards program.</li>
                </ul>
            </div>

            <!-- Recommendations -->
            <div class="recommendations">
                <h3>Recommended for You</h3>
                <p>Based on your preferences:</p>
                <ul>
                    <li><a href="menu.php#espresso">Try our Double Shot Espresso</a></li>
                    <li><a href="menu.php#latte">Check out our Hazelnut Latte</a></li>
                    <li><a href="menu.php#desserts">Pair with our signature Croissant</a></li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

