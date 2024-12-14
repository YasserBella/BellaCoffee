<?php
// Start a session for user login or tracking

// Example: checking if a user is logged in
$isLoggedIn = isset($_SESSION['user_id']) ? true : false;
?>

<header>
    <div class="container">
        <div class="logo">
            <h1><a href="/BellaCoffee/pages/index.php">BellaCoffee</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="../pages/index.php">Home</a></li>
                <li><a href="../pages/menu.php" class="active">Menu</a></li>
                <li><a href="../pages/about.php">About Us</a></li>
                <li><a href="../pages/contact.php">Contact</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="../pages/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../pages/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
