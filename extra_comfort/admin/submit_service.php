<?php
session_start();
include('include/config.php');




// Get form data
$name = $_POST['name'];
$full_name = $_POST['full_name'];
$product_type = $_POST['product_type'];
$qty = $_POST['qty'];
$size = $_POST['size'];
$mrp = $_POST['mrp'];

// Insert into DB
$sql = "INSERT INTO product (name, full_name, product_type, qty, size, mrp)
        VALUES ('$name', '$full_name', '$product_type', '$qty', '$size', '$mrp')";

if ($con->query($sql)) {
    $_SESSION['msg'] = "Service added successfully.";
} else {
    $_SESSION['msg'] = "Error: " . $con->error;
}
$con->close();

echo $sql;
// Redirect back to main page
header("Location: product.php"); // change to your actual page if different
exit();
?>
