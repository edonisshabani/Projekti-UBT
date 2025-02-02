<?php
session_start();
include('../config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['message'] = "You must log in as an admin first.";
    header("Location: ../login.php");
    exit();
}

$auth_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$auth_id' LIMIT 1";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    session_destroy();
    header("Location: ../login.php");
    exit();
}
?>