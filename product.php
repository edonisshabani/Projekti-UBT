<?php
session_start();
include 'config.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$product_id = intval($_GET['id']); 

$query = "SELECT * FROM products WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Product not found!";
    exit();
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/707ec381ad.js" crossorigin="anonymous"></script>
    <style>
    
    
.center-text {
    text-align: center;
    margin-bottom: 30px;
}

.center-text h2 {
    font-size: 48px;
    font-weight: bold;
    color: #143646;
}

.featured-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
    padding: 20px;
    margin: 0 auto;
    max-width: 1500px;
}

.product-card {
    width: 23%;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    transition: 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    cursor: pointer;
}

.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.product-details {
    padding: 15px;
}

.product-details h5 {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.product-details p {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.price-container {
    display: flex;
    justify-content: center;
    align-items: baseline;
    gap: 8px;
}

.original-price {
    font-size: 14px;
    color: #888;
    text-decoration: line-through;
}

.discount {
    font-size: 14px;
    color: #d9534f;
    font-weight: bold;
}

.final-price {
    font-size: 18px;
    color: #333;
    font-weight: 700;
}
.button-container {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}

.add-to-cart, .buy-now {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
}

.add-to-cart {
    background-color: #143646;
    color: white;
}

.add-to-cart:hover {
    background-color: #0e2630;
}
.add-to-cart i {
padding-left: 7px;
}

.buy-now {
    background-color: #007bff;
    color: white;
}

.buy-now:hover {
    background-color: #0056b3;
}

/* Responsive design i shfaqjes se produkteve*/
@media (max-width: 1210px) {
    .product-card {
        width: 48%;
    }
}

@media (max-width: 900px) {
    .product-card {
        width: 100%;
    }

    .center-text h2 {
        font-size: 36px;
    }
}</style>
</head>
<body>
     <!----Menu e Webit--->
     <header>
            <a href="#" class="logo">EA10</a>
            <button class="mob-menu"><i class="fa-solid fa-bars"></i></button>
            <ul class="navlist">
                <li><a href="index.php">Home</a></li>
                <li><a href="#featured">Featured</a></li>
                <li><a href="#new-arrivals">New</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="aboutus.php">About Us</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="user-section">
                        <div class="user-icon">
                            <img src="img/user-icon.png" alt="User Icon">
                            <div class="dropdown-content">
                                <a href="logout.php">Logout</a>
                            </div>
                        </div>
                        <span class="user-name" ><?= htmlspecialchars($_SESSION['user_name']); ?></span>
                    </li>
                <?php else: ?>
                    <li><a href="login.php">LogIn</a></li>
                <?php endif; ?>
            </ul>
        </header>
        

    <main>
        <div class="container">
            <div class="product-page">
                <div class="product-images">
                    <img src="<?= htmlspecialchars($product['image']); ?>" class="main-image" id="mainImage">
                </div>
                <div class="product-details">
                    <h1 class="product-title"><?= htmlspecialchars($product['name']); ?></h1>
                    <div class="price-container">
                        <span class="original-price">$<?= number_format($product['price'], 2); ?></span>
                        <span class="discount">-<?= $product['discount']; ?>%</span>
                        <span class="final-price">$<?= number_format($product['price'] * (1 - $product['discount'] / 100), 2); ?></span>
                    </div>
                    <p class="description"><?= htmlspecialchars($product['category']); ?></p>
                    
                    <form action="add_to_cart.php" method="POST" style="display: flex; align-items: center; gap: 15px;">
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        
                        <div style="display: flex; align-items: center; border: 1px solid #ccc; border-radius: 5px; overflow: hidden;">
                            <button type="button" onclick="decreaseQuantity()" style="padding: 8px 12px; background: #eee; border: none;">-</button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= $product['quantity']; ?>" 
                                style="width: 50px; text-align: center; border: none;">
                            <button type="button" onclick="increaseQuantity()" style="padding: 8px 12px; background: #eee; border: none;">+</button>
                        </div>
                        
                        <button type="submit" class="add-to-cart" style="margin-left: auto;">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
                    </form>


                    <button class="buy-now">Buy Now</button>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <!-- Pjesa e Informatave -->
            <div class="footer-about">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum ipsam illo, adipisci praesentium aperiam et.</p>
            </div>

            <!-- Pjesa E linqeve -->
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#featured">Featured</a></li>
                    <li><a href="#new-arrivals">New Arrivals</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>

            <!-- Pjesa e kontaktit -->
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p><strong>Email:</strong> ubt@uni-ubt.net</p>
                <p><strong>Phone:</strong> +383 12 345 678</p>
            </div>

            <!-- Pjesa e rrjeteve sociale -->
            <div class="footer-social">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="https://www.facebook.com/ubthighereducationinstitution/" target="_blank" class="facebook"><i class="fa-brands fa-facebook"></i> Facebook</a>
                    <a href="https://www.instagram.com/ubt_official/?hl=en" target="_blank" class="instagram"><i class="fa-brands fa-instagram"></i> Instagram</a>
                </div>
            </div>
        </div>

        <!-- Pjesa e copyright -->
        <div class="footer-bottom">
            <p>Copyright © 2024 All rights reserved | This Website is made by Two Students of "UBT College" E.SH & A.N</p>
        </div>
    </footer>
    <script>
    function decreaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value--;
        }
    }

    function increaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        let max = parseInt(quantityInput.max);
        if (quantityInput.value < max) {
            quantityInput.value++;
        }
    }
</script>
    <script src="script/main.js"></script>
</body>
</html>
