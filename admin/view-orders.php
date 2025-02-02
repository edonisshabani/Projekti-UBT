<?php
include '../config.php';
include('authentication.php');

$query = "SELECT * FROM orders ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="view-users.php">Manage Users</a></li>
            <li><a href="view-messages.php">View Messages</a></li>
            <li><a href="view-orders.php" class="active">View Orders</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="admin-container">
            <h2>Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Shipping Address</th>
                        <th>Phone</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['shipping_name']; ?></td>
                            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td><?php echo $row['shipping_address']; ?></td>
                            <td><?php echo $row['shipping_phone']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <a href="view-order-details.php?id=<?php echo $row['id']; ?>" class="view-btn">View Details</a>
                                <a href="delete-order.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>