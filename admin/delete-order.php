<?php
session_start();
include '../config.php';
include('authentication.php');

if (!isset($_GET['id'])) {
    header("Location: view-orders.php");
    exit();
}

$order_id = $_GET['id'];


$delete_items_query = "DELETE FROM order_items WHERE order_id = $order_id";
if (mysqli_query($con, $delete_items_query)) {
    
    $delete_order_query = "DELETE FROM orders WHERE id = $order_id";
    if (mysqli_query($con, $delete_order_query)) {
        $_SESSION['success'] = "Order deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting order: " . mysqli_error($con);
    }
} else {
    $_SESSION['error'] = "Error deleting order items: " . mysqli_error($con);
}

header("Location: view-orders.php");
exit();
?>