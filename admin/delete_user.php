<?php
session_start();
include '../config.php';
include('authentication.php');

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $query = "DELETE FROM cart WHERE user_id = $user_id";
    mysqli_query($con, $query);

    $query = "DELETE FROM users WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['message'] = "User deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting user: " . mysqli_error($con);
    }
} else {
    $_SESSION['message'] = "Invalid user ID!";
}

header("Location: view-users.php");
exit();
?>