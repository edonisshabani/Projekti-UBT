<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$database = "projekti_ubt"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: ");
} else {
    echo "DB connected";
}
?>

