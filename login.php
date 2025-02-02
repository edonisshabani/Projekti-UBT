<?php
session_start();
include 'config.php';

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: index.html");
            exit();
        } else {
            $message = "Invalid password!";
            $type = "error";
        }
    } else {
        $message = "User not found!";
        $type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main">
    <a href="index.html" style="position: absolute; top: 20px; left: 20px; font-size: 30px; text-decoration: none; color: #007acc;">&#8592;</a>
    <h1>Welcome Back</h1>
    <p class="subtitle">Log in to your account</p>
    <p id="message" class="<?= $type === 'error' ? 'error-message' : ($type === 'success' ? 'success-message' : '') ?>">
        <?= htmlspecialchars($message) ?>
    </p>

    <div class="su">
        <div class="suc">
            <form method="POST" class="suf" action="login.php">
                <div class="ftb">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required />
                </div>

                <div class="ftb">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required />
                </div>

                <div class="ftb">
                    <button type="submit" id="submit" class="submit">Log In</button>
                </div>
            </form>

            <p class="loginhere">
                Don't have an account? <a href="Register.php">Sign Up</a>
            </p>
        </div>
    </div>
</div>

<script src="script/main.js"></script>
</body>
</html>
