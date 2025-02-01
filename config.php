<?php
$con = mysqli_connect("localhost", "root", "", "projekti_ubt");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else{
    echo 'Connected sucesfully';
}
?>