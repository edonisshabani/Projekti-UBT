<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $msgText = mysqli_real_escape_string($con, $_POST['message']);

        $query = "INSERT INTO message (message_name, message_email, message_description) VALUES ('$name', '$email', '$msgText')";

       
        if (mysqli_query($con, $query)) {
            header("Location: contact.html?status=success");
            exit();
        } else {
            header("Location: contact.html?status=error");
            exit();
        }
    } else {
        header("Location: contact.html?status=error");
        exit();
    }
}
?>
