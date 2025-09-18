<?php
include('include/config.php');

// Get POST data from the form
$name = $_POST['name'];
$full_name = $_POST['full_name'];
$product_type = $_POST['product_type'];
$qty = $_POST['qty'];
$size = $_POST['size'];
$mrp = $_POST['mrp'];
$features = $_POST['features'];
$image = $_POST['image'];

// Insert the data into the database
$sql = "INSERT INTO products (name, full_name, product_type, qty, size, mrp, features, image)
        VALUES ('$name', '$full_name', '$product_type', '$qty', '$size', '$mrp', '$features', '$image')";

if ($con->query($sql) === TRUE) {
    echo "New product added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>