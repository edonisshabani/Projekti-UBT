<?php
session_start();
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM message WHERE id = $id";
    mysqli_query($con, $query);
}

header("Location: view-messages.php");
exit();
?>
