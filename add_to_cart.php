<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit();
}

if (!isset($_POST['product_id'])) {
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

$query = "SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $new_quantity = $row['quantity'] + $quantity;
    $update_query = "UPDATE cart SET quantity = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($update_stmt, "ii", $new_quantity, $row['id']);
    mysqli_stmt_execute($update_stmt);
} else {
    $insert_query = "INSERT INTO cart (user_id, product_id, quantity, created_at) VALUES (?, ?, ?, NOW())";
    $insert_stmt = mysqli_prepare($con, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "iii", $user_id, $product_id, $quantity);
    mysqli_stmt_execute($insert_stmt);
}

$cart_query = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = ?";
$cart_stmt = mysqli_prepare($con, $cart_query);
mysqli_stmt_bind_param($cart_stmt, "i", $user_id);
mysqli_stmt_execute($cart_stmt);
$cart_result = mysqli_stmt_get_result($cart_stmt);
$cart_row = mysqli_fetch_assoc($cart_result);
$cart_count = $cart_row['total_items'] ? $cart_row['total_items'] : 0;

echo $cart_count;
exit();
?>
