<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $query = "INSERT INTO message (message_name, message_email, message_description) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($con, $query)) {
        $_SESSION['status'] = "Message sent successfully!";
    } else {
        $_SESSION['status'] = "Database error: " . mysqli_error($con);
    }
}
?>
