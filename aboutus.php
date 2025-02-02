<?php 
session_start();
include 'config.php';

$sql = "SELECT * FROM about_us LIMIT 1";
$result = $con->query($sql);
$about_us = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/707ec381ad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/707ec381ad.css" crossorigin="anonymous">
</head>
<body>
    
    <header>
        <a href="#" class="logo">EA10</a>
        <button class="mob-menu" ><i class="fa-solid fa-bars"></i></button>
        <ul class="navlist">
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="login.php">Log In</a></li>
        </ul>
    </header>

    <section class="buys">
        <div class="buyc">
            <div class="buyt">
                <h2><?= $about_us['title']; ?></h2>
                <p><?= $about_us['content']; ?></p>
                <a href="#" class="learnbtn">Learn More</a>
            </div>
            <div class="buy-image">
                <img src="<?= $about_us['image_url']; ?>" alt="Why Choose Us">
            </div>
        </div>
    </section>

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
    
    <script src="script/main.js"></script>
</body>
</html>
