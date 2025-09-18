<?php
$host = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default is empty for XAMPP
$database = "extra_comfort"; // replace with your actual DB name

$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>