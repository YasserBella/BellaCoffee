<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $cart = $_SESSION['cart'];

    // Logic to save order in the database
    unset($_SESSION['cart']); // Clear cart after checkout

    echo "Thank you! Your order has been placed.";
} else {
    echo "<form method='POST' action='checkout.php'>
            <p>Confirm your order:</p>
            <button type='submit'>Place Order</button>
          </form>";
}
?>
