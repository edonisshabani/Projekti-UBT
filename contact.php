<?php
session_start();
include('config.php');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$cart_count = 0;

if ($user_id) {
    $cart_query = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = $user_id";
    $cart_result = mysqli_query($con, $cart_query);
    $cart_row = mysqli_fetch_assoc($cart_result);
    $cart_count = $cart_row['total_items'] ? $cart_row['total_items'] : 0;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $msgText = mysqli_real_escape_string($con, $_POST['message']);

        $query = "INSERT INTO message (message_name, message_email, message_description) VALUES ('$name', '$email', '$msgText')";

        if (mysqli_query($con, $query)) {
            header("Location: contact.php?status=success");
            exit();
        } else {
            header("Location: contact.php?status=error");
            exit();
        }
    } else {
        header("Location: contact.php?status=error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/707ec381ad.js" crossorigin="anonymous"></script>
    <title>Contact Us</title>
    <style>
        .message-box {
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<header>
    <a href="#" class="logo">EA10</a>
    <button class="mob-menu"><i class="fa-solid fa-bars"></i></button>
    <ul class="navlist">
        <li><a href="index.php">Home</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="aboutus.php">About Us</a></li>

        <?php if ($user_id): ?>
            <li class="user-section">
                <div class="user-icon">
                    <img src="img/user-icon.png" alt="User Icon">
                    <div class="dropdown-content">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
                <span class="user-name"><?= htmlspecialchars($_SESSION['user_name']); ?></span>
            </li>
            <li>
                <a href="cart.php" class="cart-icon">
                    🛒 Cart 
                    <span id="cart-count" class="cart-count"><?= $cart_count; ?></span>
                </a>
            </li>
        <?php else: ?>
            <li><a href="login.php">LogIn</a></li>
        <?php endif; ?>
    </ul>
</header>

<main class="contmain">
    <div class="cont-form">
        <div class="div-1hf">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23583.153899268826!2d21.148933900167936!3d42.36609318743188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13547e5d2cdacd71%3A0xec0e1a604157e8b5!2sFerizaj!5e0!3m2!1sen!2s!4v1733450754848!5m2!1sen!2s" 
                    class="contm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="div-2hf">
            <section class="contact-us">
                <div class="formcont">
                    <h2>Contact Us</h2>
                    <p>Fill out the form below to get in touch with us. </p>

                    <div id="messageBox" class="message-box">
                        <?php
                        if (isset($_GET['status'])) {
                            if ($_GET['status'] === 'success') {
                                echo 'Thank you! Your message has been sent successfully.';
                                echo '<div class="success">Message sent successfully!</div>';
                            } else {
                                echo 'An error occurred. Please try again.';
                                echo '<div class="error">There was an error while sending your message.</div>';
                            }
                        }
                        ?>
                    </div>
                    <form action="contact.php" method="post" class="contact-form" id="contactForm">
                        <div class="forminp">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="forminp">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="forminp">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Write your message" required></textarea>
                        </div>
                        <button type="submit" class="btnmsg">Send Message</button>
                    </form>                       
                </div>
            </section>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="footer-container">
      <!-- Pjesa e Informatave -->
      <div class="footer-about">
        <h3>About Us</h3>
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum ipsam illo, adipisci praesentium aperiam et.</p>
      </div>
  
      <!-- Pjesa E linqeve -->
      <div class="footer-links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Featured</a></li>
          <li><a href="#">New Arrivals</a></li>
          <li><a href="contact.php">Contact</a></li>
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
          <a href="#" class="facebook"><i class="fa-brands fa-facebook"></i> Facebook</a>
          <a href="#" class="instagram"><i class="fa-brands fa-instagram"></i> Instagram</a>
          <a href="#" class="twitter"><i class="fa-brands fa-twitter"></i> Twitter</a>
        </div>
      </div>                  
    </div>
  
    <!-- Pjesa e copyright -->
    <div class="footer-bottom">
      <p>Copyright © 2024 All rights reserved | This Website is made by Two Students of "UBT College" E.SH & A.N</p>
    </div>
</footer>

<script>

    function showMessage() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const messageBox = document.getElementById('messageBox');

        if (status === 'success') {
            messageBox.textContent = 'Thank you! Your message has been sent successfully.';
            messageBox.classList.add('success');
        } else if (status === 'error') {
            messageBox.textContent = 'An error occurred. Please try again.';
            messageBox.classList.add('error');
        }
    }
    window.onload = showMessage;
</script>
<script src="script/main.js"></script>
</body>
</html>