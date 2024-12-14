<?php
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Function to fetch menu items (should be replaced with database queries)
function getMenuItems() {
    return [
        ['name' => 'Espresso', 'image' => 'coffee1.jpg', 'description' => 'Strong and bold. Perfect for mornings.', 'price' => 3.50],
        ['name' => 'Latte', 'image' => 'coffee2.jpg', 'description' => 'Rich espresso with velvety milk.', 'price' => 4.50],
        ['name' => 'Cappuccino', 'image' => 'coffee3.jpg', 'description' => 'A balance of espresso and frothy milk.', 'price' => 4.00],
        ['name' => 'Americano', 'image' => 'coffee4.jpg', 'description' => 'Espresso diluted with hot water.', 'price' => 3.00],
        ['name' => 'Mocha', 'image' => 'coffee5.jpg', 'description' => 'Espresso with chocolate and milk.', 'price' => 5.00],
    ];
}

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $itemName = trim($_POST['name']);
    $itemPrice = (float) trim($_POST['price']);

    if (!empty($itemName) && $itemPrice > 0) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $itemExists = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['name'] === $itemName) {
                $cartItem['quantity']++;
                $itemExists = true;
                break;
            }
        }

        if (!$itemExists) {
            $_SESSION['cart'][] = [
                'name' => $itemName,
                'price' => $itemPrice,
                'quantity' => 1,
            ];
        }

        header('Location: cart.php');
        exit;
    } else {
        echo "Invalid item details.";
    }
}

// Remove item from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $itemName = trim($_POST['name']);

    if (!empty($itemName) && isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $cartItem) {
            if ($cartItem['name'] === $itemName) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
                break;
            }
        }
    }

    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BellaCoffee - Menu</title>
    <link rel="stylesheet" href="../assets/css/menu.css">
</head>
<body>

    <!-- Include Header -->
    <?php include('../includes/header.php'); ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Discover Our Menu</h2>
            <p>Explore a variety of coffee blends crafted to perfection.</p>
        </div>
    </section>

    <!-- Menu Items Section -->
    <section class="menu-items">
        <div class="container">
            <h2>Our Coffee Selection</h2>
            <div class="item-cards">
                <?php
                    $menuItems = getMenuItems();
                    foreach ($menuItems as $item) {
                        echo '
                        <div class="item-card">
                            <img src="../assets/images/' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '">
                            <h3>' . htmlspecialchars($item['name']) . '</h3>
                            <p>' . htmlspecialchars($item['description']) . '</p>
                            <span class="price">$' . number_format($item['price'], 2) . '</span>
                            <form method="POST" action="menu.php">
                                <input type="hidden" name="name" value="' . htmlspecialchars($item['name']) . '">
                                <input type="hidden" name="price" value="' . htmlspecialchars($item['price']) . '">
                                <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                            </form>
                        </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Cart Overview Section -->
    <section class="cart-overview">
        <div class="container">
            <h2>Your Cart</h2>
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                echo '<ul>';
                foreach ($_SESSION['cart'] as $cartItem) {
                    echo '<li>' . htmlspecialchars($cartItem['name']) . ' x ' . $cartItem['quantity'] . ' - $' . number_format($cartItem['price'] * $cartItem['quantity'], 2) . '</li>';
                    echo '
                    <form method="POST" action="remove_item.php">
                        <input type="hidden" name="name" value="' . htmlspecialchars($cartItem['name']) . '">
                        <button type="submit" name="remove_item" class="btn">Remove</button>
                    </form>';
                }
                echo '</ul>';
                echo '<a href="checkout.php" class="btn">Proceed to Checkout</a>';
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready for your perfect cup?</h2>
            <p>Visit us today and enjoy your favorite coffee blend fresh and delicious.</p>
            <a href="../pages/contact.php" class="btn">Find Us</a>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
