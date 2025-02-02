<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $query = "DELETE FROM users WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location: view-users.php?message=User Deleted Successfully");
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
} else {
    echo "Invalid user ID!";
}
?>
