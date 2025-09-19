<?php
include('include/config.php');

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $full_name = trim($_POST['full_name']);
    $prodct_type = trim($_POST['prodct_type']);
    $qty = intval($_POST['qty']); // qty should be integer
    $size = trim($_POST['size']);
    $mrp = floatval($_POST['mrp']); // mrp as float

    if ($id > 0 && !empty($name) && !empty($full_name) && $qty > 0 && $mrp > 0) {
        $stmt = $con->prepare("UPDATE product SET name = ?, full_name = ?, prodct_type = ?, qty = ?, size = ?,  mrp = ? WHERE id = ?");
        $stmt->bind_param("sssisdi", $name, $full_name, $prodct_type, $qty, $size, $mrp, $id);

        if ($stmt->execute()) {
            echo "success"; // return success to AJAX
        } else {
            echo "error: " . $stmt->error;
        }
    } else {
        echo "invalid";
    }
    exit;
}


// If loaded for editingss
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $con->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product):
        ?>

        <form method="POST" id="updateForm">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>">
            </div>
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= $product['full_name'] ?>">
            </div>
            <div class="mb-3">
                <label>Product Type</label>
                <input type="text" name="prodct_type" class="form-control" value="<?= $product['prodct_type'] ?>">
            </div>
            <div class="mb-3">
                <label>Qty</label>
                <input type="number" name="qty" class="form-control" value="<?= $product['qty'] ?>">
            </div>
            <div class="mb-3">
                <label>Size</label>
                <input type="text" name="size" class="form-control" value="<?= $product['size'] ?>">
            </div>
            <div class="mb-3">
                <label>MRP</label>
                <input type="number" name="mrp" class="form-control" value="<?= $product['mrp'] ?>">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>

        <script>
            $("#updateForm").on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    url: "edit_product.php", // same file handles update
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.trim() === "success") {
                            $("#editModal").modal("hide");
                        }
                        location.reload(); // reload table
                    }
                });
            });
        </script>

        <?php
    else:
        echo "Product not found!";
    endif;
}
?>