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
          WHERE cart.user_id = $user_id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .quantity-input {
            width: 50px;
            padding: 5px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-update {
            background-color: #007bff;
            color: white;
            padding: 5px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }
        .btn-update:hover {
            background-color: #0056b3;
        }
        .btn-remove {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-remove:hover {
            background-color: #c82333;
        }
        .btn-checkout {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
        }
        .btn-checkout:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top:100px;">
<a href="index.php" style="position: absolute; top: 20px; left: 20px; font-size: 30px; text-decoration: none; color: #007acc;">&#8592;</a>
    <h2>Your Shopping Cart</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><img src="<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" class="product-img"></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td>$<?= number_format($row['price'], 2); ?></td>
                <td>
                    <form method="post" action="update_cart.php">
                        <input type="hidden" name="cart_id" value="<?= $row['id']; ?>">
                        <input type="number" name="quantity" value="<?= $row['quantity']; ?>" min="1" class="quantity-input">
                        <button type="submit" class="btn-update">Update</button>
                    </form>
                </td>
                <td>$<?= number_format($row['price'] * $row['quantity'], 2); ?></td>
                <td>
                    <a href="remove_from_cart.php?id=<?= $row['id']; ?>" class="btn-remove">Remove</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="checkout.php" class="btn-checkout">Proceed to Checkout</a>
    <?php } else { ?>
        <p style="text-align: center;">Your cart is empty.</p>
    <?php } ?>
</div>

</body>
</html>
