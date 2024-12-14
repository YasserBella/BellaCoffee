<?php
// Start the session to track login state
session_start();

// Example: checking if a user is logged in
$isLoggedIn = isset($_SESSION['user_id']) ? true : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BellaCoffee - About Us</title>
    <link rel="stylesheet" href="../assets/css/about.css">
</head>
<body>

    <!-- Header Section -->
    <?php include('../includes/header.php'); ?>

    <!-- About Us Section -->
    <section class="about">
        <div class="container">
            <h2>About BellaCoffee</h2>
            <p>BellaCoffee is not just a coffee shop; it's a passion for quality, craftsmanship, and community. Our journey started with the simple idea of offering the finest coffee blends made from the freshest beans.</p>

            <h3>Our Story</h3>
            <p>Founded in 2024, BellaCoffee was born out of a love for great coffee and a desire to create a space where people can enjoy a perfect cup in a welcoming atmosphere. From our humble beginnings to now, we've always focused on providing top-notch service and exceptional coffee.</p>

            <h3>Our Values</h3>
            <ul>
                <li>Quality: Only the best beans make it into our coffee cups.</li>
                <li>Community: We believe in creating a place where everyone feels at home.</li>
                <li>Sustainability: We source our coffee responsibly and minimize waste.</li>
            </ul>

            <h3>Our Coffee</h3>
            <p>At BellaCoffee, we serve a variety of expertly crafted coffee drinks, each brewed with love and care. From espresso shots to lattes, our menu is designed to meet the needs of every coffee lover.</p>
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
