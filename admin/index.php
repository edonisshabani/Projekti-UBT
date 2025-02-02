<?php
include('../config.php');
session_start();
if (!isset($_SESSION["visits"])) {
    $_SESSION["visits"] = 1;
} else {
    $_SESSION["visits"]++;
}

$sql = "SELECT * FROM products";
$result = $con->query($sql);

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_error = $_FILES['image']['error'];
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($image_ext, $allowed_ext) && $image_size <= 5000000) {
        $image_new_name = uniqid('', true) . '.' . $image_ext;
        $image_destination = 'img/' . $image_new_name;

        if (move_uploaded_file($image_tmp, $image_destination)) {
            $add_query = "INSERT INTO products (name, price, discount, quantity, image) 
                          VALUES ('$name', '$price', '$discount', '$quantity', '$image_destination')";
            if ($con->query($add_query)) {
                header("Location: index.php");
                exit();
            } else {
                echo "<p style='color:red;'>Error adding product!</p>";
            }
        } else {
            echo "<p style='color:red;'>Error uploading image!</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid file format or file too large!</p>";
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM products WHERE id = '$delete_id'";
    if ($con->query($delete_query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red;'>Error deleting product!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="view-users.php">Manage Users</a></li>
            <li><a href="view-messages.php">View Messages</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">

        <div class="admin-container">
            <h3>Site Visit Counter</h3>
            <p>You have visited this page <?= $_SESSION["visits"] ?> times.</p>
        </div>

        <div class="admin-container">
            <h3>Product List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>$" . $row['price'] . "</td>
                                    <td>-" . $row['discount'] . "%</td>
                                    <td>" . $row['quantity'] . "</td>
                                    <td><img src='" . $row['image'] . "' alt='" . $row['name'] . "' width='50'></td>
                                    <td>
                                        <a href='?delete_id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No products found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="admin-container">
            <h3>Add New Product</h3>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" required placeholder="Enter product name">
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required placeholder="Enter product price">
                </div>

                <div class="form-group">
                    <label for="discount">Discount (%):</label>
                    <input type="number" id="discount" name="discount" required placeholder="Enter product discount">
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required placeholder="Enter product quantity">
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" required>
                </div>

                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>
    </div>
</body>
</html>
