<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT cart.id, products.name, products.price, products.image, cart.quantity 
          FROM cart 
          JOIN products ON cart.product_id = products.id 
          WHERE cart.user_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$total_amount = 0;
$cart_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
    $total_amount += $row['price'] * $row['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shipping_name = mysqli_real_escape_string($con, $_POST['shipping_name']);
    $shipping_address = mysqli_real_escape_string($con, $_POST['shipping_address']);
    $shipping_phone = mysqli_real_escape_string($con, $_POST['shipping_phone']);
    $shipping_zip = mysqli_real_escape_string($con, $_POST['shipping_zip']);
    $shipping_country = 'Kosova';

    $insert_order_query = "INSERT INTO orders (user_id, total_amount, shipping_name, shipping_address, shipping_phone, shipping_zip, shipping_country) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insert_order_query);
    mysqli_stmt_bind_param($stmt, "idsssss", $user_id, $total_amount, $shipping_name, $shipping_address, $shipping_phone, $shipping_zip, $shipping_country);
    
    if (mysqli_stmt_execute($stmt)) {
        $order_id = mysqli_insert_id($con);

        foreach ($cart_items as $item) {
            $insert_order_item_query = "INSERT INTO order_items (order_id, product_name, quantity, price) 
                                        VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $insert_order_item_query);
            mysqli_stmt_bind_param($stmt, "isid", $order_id, $item['name'], $item['quantity'], $item['price']);
            mysqli_stmt_execute($stmt);
        }

        $clear_cart_query = "DELETE FROM cart WHERE user_id = ?";
        $stmt = mysqli_prepare($con, $clear_cart_query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);

        header("Location: order_confirmation.php?order_id=$order_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .checkout-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
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
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn-confirm {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-confirm:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
    <a href="index.php" style="position: absolute; top: 20px; left: 20px; font-size: 30px; text-decoration: none; color: #007acc;">&#8592;</a>
        <h2>Checkout</h2>

        <h3>Order Summary</h3>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cart_items)): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-img"></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td><?= intval($item['quantity']) ?></td>
                            <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No products found in the cart.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <h3>Total: $<?= number_format($total_amount, 2) ?></h3>

        <h3>Shipping Information</h3>
        <form method="post">
            <div class="form-group">
                <label for="shipping_name">Full Name</label>
                <input type="text" id="shipping_name" name="shipping_name" required>
            </div>
            <div class="form-group">
                <label for="shipping_address">Address</label>
                <input type="text" id="shipping_address" name="shipping_address" required>
            </div>
            <div class="form-group">
                <label for="shipping_phone">Phone Number</label>
                <input type="text" id="shipping_phone" name="shipping_phone" required>
            </div>
            <div class="form-group">
                <label for="shipping_zip">Zip Code</label>
                <input type="text" id="shipping_zip" name="shipping_zip" required>
            </div>
            <div class="form-group">
                <label for="shipping_country">Country</label>
                <input type="text" id="shipping_country" name="shipping_country" value="Kosova" readonly>
            </div>
            <button type="submit" class="btn-confirm">Proceed to Checkout</button>
        </form>
    </div>
</body>
</html>
