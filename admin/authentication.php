<?php
session_start();
include('config.php');

if (!isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "You must log in first";
    header("Location: login.php");
    exit(0);
}

$auth_id = $_SESSION['auth_user']['user_id'];
$query = "SELECT * FROM users WHERE id = '$auth_id' LIMIT 1";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    session_destroy();
    header("Location: login.php");
    exit(0);
}