<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default password is empty
$database = "projekti_ubt"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
