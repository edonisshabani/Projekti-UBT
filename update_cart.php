<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['cart_id'], $_POST['quantity'])) {
    $cart_id = intval($_POST['cart_id']);
    $quantity = max(1, intval($_POST['quantity']));

    $query = "UPDATE cart SET quantity = $quantity WHERE id = $cart_id";
    mysqli_query($con, $query);
}

header("Location: cart.php");
exit();
?>
