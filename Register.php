<?php
session_start();
include 'config.php';

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $message = "Email is already registered!";
        $type = "error";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $insert_query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        
        if (mysqli_query($con, $insert_query)) {
            $message = "Registration successful! Please log in.";
            $type = "success";
        } else {
            $message = "Error during registration. Please try again.";
            $type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main">
    <a href="index.html" style="position: absolute; top: 20px; left: 20px; font-size: 30px; text-decoration: none; color: #007acc;">&#8592;</a>
    <h1>Create Your Account</h1>
    <p class="subtitle">Sign up to get started</p>
    <p id="message" class="<?= $type === 'error' ? 'error-message' : ($type === 'success' ? 'success-message' : '') ?>">
        <?= htmlspecialchars($message) ?>
    </p>

    <div class="su">
        <div class="suc">
            <form method="POST" class="suf" action="register.php">
                <div class="ftb">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" required />
                </div>

                <div class="ftb">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required />
                </div>

                <div class="ftb">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required />
                </div>

                <div class="ftb">
                    <button type="submit" id="submit" class="submit">Register</button>
                </div>
            </form>

            <p class="loginhere">
                Already have an account? <a href="login.php">Log In</a>
            </p>
        </div>
    </div>
</div>

<script src="script/main.js"></script>
</body>
</html>
