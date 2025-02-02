<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = mysqli_real_escape_string($con, $_GET['order_id']);

$query = "SELECT orders.*, users.name, users.email 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          WHERE orders.id = $order_id AND orders.user_id = " . $_SESSION['user_id'];
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Order not found.";
    exit();
}

$order = mysqli_fetch_assoc($result);

$query = "SELECT * FROM order_items WHERE order_id = $order_id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h1>Order Confirmation</h1>
        <p>Thank you for your order!</p>
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> <?= $order['id']; ?></p>
        <p><strong>Total Amount:</strong> $<?= number_format($order['total_amount'], 2); ?></p>
        <p><strong>Shipping Address:</strong> <?= $order['shipping_address']; ?></p>

        <h2>Order Items</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['product_name']; ?></td>
                <td><?= $row['quantity']; ?></td>
                <td>$<?= number_format($row['price'], 2); ?></td>
                <td>$<?= number_format($row['price'] * $row['quantity'], 2); ?></td>
            </tr>
            <?php } ?>
        </table>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>