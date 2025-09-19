<?php
include('include/config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = $con->prepare("SELECT * FROM product WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<div class='product-preview'>";

        // ✅ Image Preview Section
        if (!empty($row['image'])) {
            $images = json_decode($row['image'], true);
            echo "<div class='mb-3 d-flex flex-wrap'>";
            foreach ($images as $img) {
                echo "<div class='m-2'>
                        <img src='uploads/$img'
                             style='width:150px; height:150px; object-fit:cover; border:1px solid #ddd; border-radius:8px;'>
                      </div>";
            }
            echo "</div>";
        } else {
            echo "<p class='text-muted'>No images uploaded.</p>";
        }

        // ✅ Product Details
        echo "<ul class='list-group'>";
        echo "<li class='list-group-item'><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</li>";
        echo "<li class='list-group-item'><strong>Full Name:</strong> " . htmlspecialchars($row['full_name']) . "</li>";
        echo "<li class='list-group-item'><strong>Product Type:</strong> " . htmlspecialchars($row['prodct_type']) . "</li>";
        echo "<li class='list-group-item'><strong>Quantity:</strong> " . htmlspecialchars($row['qty']) . "</li>";
        echo "<li class='list-group-item'><strong>Size:</strong> " . htmlspecialchars($row['size']) . "</li>";
        echo "<li class='list-group-item'><strong>MRP:</strong> ₹" . htmlspecialchars($row['mrp']) . "</li>";
        echo "</ul>";

        echo "</div>";
    } else {
        echo "<p>No product found.</p>";
    }
}
?>
 