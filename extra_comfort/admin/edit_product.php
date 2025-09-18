<?php
include('include/config.php');

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $mrp = floatval($_POST['mrp']);

    if ($id > 0 && !empty($name) && $mrp > 0) {
        $stmt = $con->prepare("UPDATE product SET name = ?, mrp = ? WHERE id = ?");
        $stmt->bind_param("sdi", $name, $mrp, $id);

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

// If loaded for editing
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
                <input type="number" name="full_name" class="form-control" value="<?= $product['mrp'] ?>">
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