<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Product</title>

        <link
            href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
            rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
        <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
        <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
        <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
        <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/plugins.css">
        <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />


    </head>

    <body>
        <div id="app">
            <?php include('include/sidebar.php'); ?>
            <div class="app-content">

                <?php include('include/header.php'); ?>

                <!-- end: TOP NAVBAR -->

                <div class="main-content">
                    <div class="wrap-content container" id="container">
                        <!-- start: PAGE TITLE -->
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Product</h1>


                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModal">
                                        Add New Service
                                    </button>

                                    <!-- Add Product Modal -->
                                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form id="addForm" enctype="multipart/form-data">
                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Full Name</label>
                                                        <input type="text" name="full_name" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Product Type</label>
                                                        <input type="text" name="prodct_type" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Qty</label>
                                                        <input type="number" name="qty" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Size</label>
                                                        <input type="text" name="size" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>MRP</label>
                                                        <input type="number" step="0.01" name="mrp" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Upload Images</label>
                                                        <input type="file" name="images[]" class="form-control" multiple>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Admin</span>
                                    </li>
                                    <li class="active">
                                        <span>Dashboard</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        <!-- end: PAGE TITLE -->

                        <table cellpadding="10" cellspacing="0" class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Name</td>
                                    <td>Full Name</td>
                                    <td>Product Type</td>
                                    <td>Qty.</td>
                                    <td>Size</td>
                                    <td>MRP</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = mysqli_query($con, "SELECT * FROM product");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['full_name']; ?></td>
                                        <td><?php echo $row['prodct_type']; ?></td>
                                        <td><?php echo $row['qty']; ?></td>
                                        <td><?php echo $row['size']; ?></td>
                                        <td><?php echo $row['mrp']; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm viewBtn"
                                                data-id="<?= $row['id'] ?>">View</button>
                                            |
                                            <button class='btn btn-primary btn-sm editBtn'
                                                data-id='<?= $row['id'] ?>'>Edit</button>
                                            |
                                            <button class="btn btn-danger">
                                                <a class="text-white" href="delete_service.php?id=<?php echo $row['id']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete this service?');">
                                                    Delete
                                                </a>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                } ?>
                            </tbody>
                        </table>

                        <!-- View Product Modal -->
                        <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Product Details</h5>
                                    </div>
                                    <div class="modal-body" id="viewProductContent"
                                        style="max-height:70vh; overflow-y:auto;">
                                        <!-- Product details + images will load here -->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Edit Product Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Product</h5>
                                    </div>
                                    <div class="modal-body" id="editFormContent"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start: FOOTER -->
            <?php include('include/footer.php'); ?>
            <!-- end: FOOTER -->

            <!-- end: SETTINGS -->
        </div>

        <script src="vendor/jquery/jquery.min.js"></script>


        <script>
            $(document).ready(function () {
                // View product
                $(".viewBtn").click(function () {
                    var id = $(this).data("id");

                    $.ajax({
                        url: "view_product.php", // new file
                        type: "GET",
                        data: { id: id },
                        success: function (response) {
                            $("#viewProductContent").html(response);
                            $("#viewModal").modal("show");
                        }
                    });
                });
            });

            // Add Product PHP
            $("#addForm").on("submit", function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "add_product.php",
                    type: "POST",
                    data: formData,
                    contentType: false,   // important
                    processData: false,   // important
                    success: function (response) {
                        if (response.trim() === "success") {
                            $("#addModal").modal("hide");
                        }
                        location.reload();
                    }
                });
            });


            // Edit Product PHP
            $(document).ready(function () {
                $(".editBtn").click(function () {
                    var id = $(this).data("id");

                    // Load edit form into modal
                    $.ajax({
                        url: "edit_product.php",
                        type: "GET",
                        data: { id: id },
                        success: function (response) {
                            $("#editFormContent").html(response);
                            $("#editModal").modal("show");
                        }
                    });
                });
            });
        </script>



        <!-- start: MAIN JAVASCRIPTS -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/modernizr/modernizr.js"></script>
        <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="vendor/switchery/switchery.min.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="vendor/autosize/autosize.min.js"></script>
        <script src="vendor/selectFx/classie.js"></script>
        <script src="vendor/selectFx/selectFx.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <!-- start: CLIP-TWO JAVASCRIPTS -->
        <script src="assets/js/main.js"></script>
        <!-- start: JavaScript Event Handlers for this page -->
        <script src="assets/js/form-elements.js"></script>
        <script>
            jQuery(document).ready(function () {
                Main.init();
                FormElements.init();
            });
        </script>
        <!-- end: JavaScript Event Handlers for this page -->
        <!-- end: CLIP-TWO JAVASCRIPTS -->
    </body>

    </html>
<?php } ?>