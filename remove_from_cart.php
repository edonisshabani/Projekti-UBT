<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = "Invalid cart item!";
    header("Location: cart.php");
    exit();
}

$cart_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$query = "DELETE FROM cart WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ii", $cart_id, $user_id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    $_SESSION['message'] = "Item removed successfully!";
} else {
    $_SESSION['message'] = "Failed to remove item.";
}

mysqli_stmt_close($stmt);
mysqli_close($con);

header("Location: cart.php");
exit();
?>
