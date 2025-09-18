<?php
session_start();
include('include/config.php');

// Check if ID is passed
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to DB (if not already included in config.php)
    $con = new mysqli("localhost", "root", "", "extra_comfort");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and execute DELETE query
    $stmt = $con->prepare("DELETE FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Service deleted successfully.";
    } else {
        $_SESSION['msg'] = "Error deleting service: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}

// Redirect back to the services page
header("Location: product.php");
exit;
?>
