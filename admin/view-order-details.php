<?php
include '../config.php';
include('authentication.php');

if (!isset($_GET['id'])) {
    header("Location: view-orders.php");
    exit();
}

$order_id = $_GET['id'];

$order_query = "SELECT * FROM orders WHERE id = $order_id";
$order_result = mysqli_query($con, $order_query);
$order = mysqli_fetch_assoc($order_result);

$items_query = "SELECT * FROM order_items WHERE order_id = $order_id";
$items_result = mysqli_query($con, $items_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="view-users.php">Manage Users</a></li>
            <li><a href="view-messages.php">View Messages</a></li>
            <li><a href="view-orders.php">View Orders</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="admin-container">
            <h2>Order Details</h2>
            <div class="order-info">
                <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
                <p><strong>Customer Name:</strong> <?php echo $order['shipping_name']; ?></p>
                <p><strong>Shipping Address:</strong> <?php echo $order['shipping_address']; ?></p>
                <p><strong>Phone:</strong> <?php echo $order['shipping_phone']; ?></p>
                <p><strong>Total Amount:</strong> $<?php echo number_format($order['total_amount'], 2); ?></p>
                <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
            </div>

            <h3>Products</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                        <tr>
                            <td><?php echo $item['product_name']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="actions">
                <a href="view-orders.php" class="back-btn">Back to Orders</a>
                <a href="delete-order.php?id=<?php echo $order['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?');">Delete Order</a>
            </div>
        </div>
    </div>
</body>
</html>