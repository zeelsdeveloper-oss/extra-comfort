<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name']);
    $full_name   = trim($_POST['full_name']);
    $product_type= trim($_POST['prodct_type']);
    $qty         = intval($_POST['qty']);    // integer
    $size        = trim($_POST['size']);
    $mrp         = floatval($_POST['mrp']);  // decimal/float

    // Upload multiple images
    $uploaded_images = [];
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = time() . "_" . basename($_FILES['images']['name'][$key]);
            $target_path = "uploads/" . $file_name;

            if (move_uploaded_file($tmp_name, $target_path)) {
                $uploaded_images[] = $file_name;
            }
        }
    }

    // Convert image list to JSON for DB
    $images_json = json_encode($uploaded_images);

    // Prepare insert query
    $stmt = $con->prepare("INSERT INTO product (name, full_name, prodct_type, qty, size, mrp, image) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // s = string, i = integer, d = double
    $stmt->bind_param("sssidss", $name, $full_name, $product_type, $qty, $size, $mrp, $images_json);

    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>