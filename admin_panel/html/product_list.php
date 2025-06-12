<?php
$connection = mysqli_connect("localhost", "root", "", "projectdb");
if (isset($_GET['did'])) {

    //for delete releted image from folder
    $query2 = mysqli_query($connection, "SELECT * FROM tbl_product WHERE product_id={$_GET['did']}");
    $fetch = mysqli_fetch_array($query2);
    $img_path = $fetch['product_img'];
    unlink($img_path);
    mysqli_query($connection, "DELETE from tbl_product where product_id='$_GET[did]'");
} else {
    mysqli_error($connection);
}
$query = mysqli_query($connection, "SELECT * FROM tbl_product JOIN tbl_product_category ON tbl_product.category_id=tbl_product_category.category_id");

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Product List</title>

    <meta name="description" content="" />

    <!-- Data table cdn-link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/materialdesignicons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js">
    </script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php
            include "sidebar.php";
            ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php
                include "navbar.php";
                ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Products /</span> Product List</h4>

                        <hr class="my-5" />

                        <!-- Bootstrap Table with Header - Light -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Filter</h5>
                                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                                    <div class="col-md-4 product_category">
                                        <select id="ProductCategory" class="form-select text-capitalize" fdprocessedid="enmacn">
                                            <option value="">Category</option>
                                            <?php
                                            $category_query = mysqli_query($connection, "SELECT * FROM `tbl_product_category`");
                                            while ($category = mysqli_fetch_array($category_query)) {
                                                echo "<option value='{$category['category_name']}'>{$category['category_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="sortOption" class="form-select">
                                            <option value="">Sort By</option>
                                            <option value="price-status-asc">Price (Low to High)</option>
                                            <option value="price-status-desc">Price (High to Low)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 product_stock">
                                        <select id="ProductStock" class="form-select text-capitalize" fdprocessedid="9ja308">
                                            <option value=""> Stock </option>
                                            <option value="Out of stock">Out of stock</option>
                                            <option value="In stock">In stock</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="table-responsive text-nowrap m-4">
                                <table class="table" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>Product</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-1">
                                        <?php
                                        while ($products = mysqli_fetch_array($query)) {
                                            echo "<tr>
                                            <td>#{$products['product_id']}</td>
                                            <td class='sorting_1'>
                                                <div class='d-flex justify-content-start align-items-center product-name'>
                                                    <div class='avatar-wrapper me-3'>
                                                        <div class='avatar rounded-2 bg-label-secondary'><img src='{$products["product_img"]}' class='rounded-2'></div>
                                                    </div>
                                                    <div class='d-flex flex-column'><span class='text-nowrap text-heading fw-medium'>{$products['product_name']}</span><small class='text-truncate d-none d-sm-block'>{$products['category_name']}</small></div>
                                                </div>
                                            </td>
                                            <td>{$products['product_quantity']}</td>
                                            <td>{$products['product_price']}</td>";
                                            echo "<td>";
                                            if ($products['stock'] == 'In stock') {
                                                echo "<h6 class='mb-0 w-px-100 text-success'><i class='mdi mdi-circle mdi-14px me-2'></i>In stock</h6>";
                                            } elseif ($products['stock'] == 'Out of stock') {
                                                echo "<h6 class='mb-0 w-px-100 text-warning'><i class='mdi mdi-circle mdi-14px me-2'></i>Out of stock</h6>";
                                            }
                                            echo "</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                        <i class='mdi mdi-dots-vertical'></i>
                                                    </button>
                                                    <div class='dropdown-menu'>
                                                        <a class='dropdown-item view-details-btn' data-bs-toggle='modal' data-bs-target='#datamodal' data-productid='{$products['product_id']}'><i class='mdi mdi-pencil-outline me-1'></i> View Details</a>
                                                        <a class='dropdown-item' href='update_product.php?uid={$products['product_id']}'><i class='mdi mdi-pencil-outline me-1'></i> Edit</a>
                                                        <a class='dropdown-item' href='product_list.php?did={$products['product_id']}'><i class='mdi mdi-trash-can-outline me-1'></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Bootstrap Table with Header - Light -->
                        <hr class="my-5" />
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php
                    include "footer.php";
                    ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <div class="modal fade" id="datamodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Details of Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Product:</td>
                                <td id="productName"></td>
                            </tr>
                            <tr>
                                <td>Category:</td>
                                <td id="productCategory"></td>
                            </tr>
                            <tr>
                                <td>Stock:</td>
                                <td id="productStock"></td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td id="productPrice"></td>
                            </tr>
                            <tr>
                                <td>Quantity:</td>
                                <td id="productQuantity"></td>
                            </tr>
                            <tr>
                                <td>Supplier:</td>
                                <td id="productSupplier"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- datatabless jquery cdn link-->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<script>
    document.querySelectorAll('.view-details-btn').forEach(item => {
        item.addEventListener('click', event => {
            const productId = item.getAttribute('data-productid');
            fetch(`get_product_details.php?productId=${productId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('productName').innerText = data.product_name;
                    document.getElementById('productCategory').innerText = data.category_name;
                    document.getElementById('productStock').innerText = data.stock;
                    document.getElementById('productPrice').innerText = data.price;
                    document.getElementById('productQuantity').innerText = data.quantity;
                    document.getElementById('productSupplier').innerText = data.supplier;
                })
                .catch(error => console.error('Error fetching product details:', error));
        });
    });
</script>

<script>
    $(document).ready(function() {
    // Check if DataTable is initialized
    if (!$.fn.DataTable.isDataTable('#myTable')) {
        $('#myTable').DataTable({
            "order": [[0, 'asc']], // Default sorting column and order
        });
    }

    // Event listener for sorting
    $('#sortOption').change(function() {
        var table = $('#myTable').DataTable(); // Get the DataTable instance
        var sortOption = $(this).val();
        var orderColumnIndex;

        // Set the index for sorting based on the option selected
        switch (sortOption) {
            case 'price-status-asc':
                orderColumnIndex = 3; // Index for price
                table.order([orderColumnIndex, 'asc']).draw(); // Sort price in ascending order
                break;
            case 'price-status-desc':
                orderColumnIndex = 3; // Index for price
                table.order([orderColumnIndex, 'desc']).draw(); // Sort price in descending order
                break;
            case 'qty-asc':
                orderColumnIndex = 2; // Index for quantity
                table.order([orderColumnIndex, 'asc']).draw(); // Sort quantity in ascending order
                break;
            case 'qty-desc':
                orderColumnIndex = 2; // Index for quantity
                table.order([orderColumnIndex, 'desc']).draw(); // Sort quantity in descending order
                break;
        }
    });

    // Event listeners for filter dropdowns
    $('#ProductCategory, #ProductStock').change(function() {
        var table = $('#myTable').DataTable(); // Get the DataTable instance
        var category = $('#ProductCategory').val();
        var stock = $('#ProductStock').val();

        // Apply filters to the table
        table.columns(1).search(category).draw(); // Filter by product category
        table.columns(4).search(stock).draw(); // Filter by stock
    });
});

</script>

</html>