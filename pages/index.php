<?php
// Start a session for user login or tracking
session_start();

// Example: checking if a user is logged in
$isLoggedIn = isset($_SESSION['user_id']) ? true : false;

// Function to fetch dynamic content (e.g., coffee products) from a database
// You can replace this part with actual database queries.
function getBestSellingCoffee() {
    return [
        ['name' => 'Espresso Blend', 'image' => 'coffee1.jpg', 'description' => 'Rich and bold, perfect for your morning wake-up.'],
        ['name' => 'Latte Blend', 'image' => 'coffee2.jpg', 'description' => 'Velvety smooth with a caramel twist.'],
        ['name' => 'Cappuccino Blend', 'image' => 'coffee3.jpg', 'description' => 'A balanced espresso with frothy milk.']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BellaCoffee - Home</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>

    <!-- Header Section -->
    <?php include('../includes/header.php'); ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Welcome to BellaCoffee</h2>
            <p>Your go-to destination for premium coffee blends brewed with care.</p>
            <a href="../pages/menu.php" class="btn">Explore Our Menu</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="container">
            <h2>About BellaCoffee</h2>
            <p>At BellaCoffee, we believe in delivering the finest coffee experiences. Our beans are handpicked, roasted to perfection, and brewed with passion. Whether you’re a coffee connoisseur or someone just discovering the joy of coffee, we offer a range of blends to suit every taste. Founded with a passion for quality, we bring the world’s best coffees straight to your cup.</p>
        </div>
    </section>

    <!-- Our Products Section -->
    <section class="products">
        <div class="container">
            <h2>Our Best-Selling Coffee Blends</h2>
            <div class="product-cards">
                <?php
                    $products = getBestSellingCoffee();
                    foreach ($products as $product) {
                        echo '
                        <div class="product-card">
                            <img src="../assets/images/' . $product['image'] . '" alt="' . $product['name'] . '">
                            <h3>' . $product['name'] . '</h3>
                            <p>' . $product['description'] . '</p>
                        </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2>What Our Customers Are Saying</h2>
            <div class="testimonial-cards">
                <div class="testimonial-card">
                    <p>"BellaCoffee is my go-to brand for coffee! Their espresso blend is unbeatable, and I can’t start my day without it!"</p>
                    <h4>Sarah, Coffee Enthusiast</h4>
                </div>
                <div class="testimonial-card">
                    <p>"I love the variety of coffee they offer. The latte blend is my personal favorite—smooth and comforting."</p>
                    <h4>John, Frequent Shopper</h4>
                </div>
                <div class="testimonial-card">
                    <p>"BellaCoffee's customer service is top-notch, and the coffee is always fresh and delicious. Highly recommend!"</p>
                    <h4>Emily, Loyal Customer</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2>Join the BellaCoffee Experience</h2>
            <p>Get exclusive updates, promotions, and more! Sign up for our newsletter today.</p>
            <a href="../pages/register.php" class="btn">Sign Up</a>
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
