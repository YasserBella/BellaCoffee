<?php
session_start();

if (isset($_POST['remove_item'])) {
    $itemName = $_POST['name'];

    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['name'] === $itemName) {
            unset($_SESSION['cart'][$index]);
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    header('Location: cart.php');
    exit;
}
?>
