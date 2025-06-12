<?php
$connection = mysqli_connect("localhost", "root", "", "projectdb");
if (isset($_GET['did'])) {
    mysqli_query($connection, "delete from tbl_order_details where order_id='$_GET[did]'");
} else {
    mysqli_error($connection);
}

$id = $_GET['record_id'];

if (isset($_GET['record_id'])) {
    $query = mysqli_query($connection, "SELECT * FROM `tbl_order_details` WHERE order_id=$id");

    $query2 = mysqli_query($connection, "SELECT * FROM `tbl_order` JOIN `tbl_customer` ON tbl_order.customer_id=tbl_customer.customer_id WHERE order_id=$id");
    $order_data = mysqli_fetch_array($query2);
    $cust_id = $order_data['customer_id'];
    $cust_name = "{$order_data['first_name']} {$order_data['last_name']}";
    $cust_img = $order_data['cust_img'];
    $contact = $order_data['contact'];
    $email = $order_data['email'];
    $order_add = $order_data['order_add'];
    $city = $order_data['city'];
    $pin_code = $order_data['pin_code'];
    $country = $order_data['country'];
    $date = $order_data['order_date'];
    $status = $order_data['payment_status'];
} else {
    echo "<script>alert('First Select the order which details you want to see..!');</script>";
    echo "<script>window.location.href='order_list.php';</script>";
}

?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Order_details</title>

    <meta name="description" content="" />

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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Content -->


                        <h4 class="py-3 mb-4">
                            <span class="text-muted fw-light">Order /</span> Order Details
                        </h4>

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">

                            <div class="d-flex flex-column justify-content-center">
                                <div class="d-flex">
                                    <h5 class="mb-0">Order #<?php echo $id; ?></h5>
                                    <?php
                                    if ($status == 'Cancelled' || $status == 'Cancelled') {
                                        echo "<span class='badge bg-label-danger mx-2 rounded-pill'>Failed</span>";
                                    }
                                    if ($status == 'Pending' || $status == 'pending') {
                                        echo "<span class='badge bg-label-warning mx-2 rounded-pill'>Pending</span>";
                                    }
                                    if ($status == 'Completed' || $status == 'completed') {
                                        echo "<span class='badge bg-label-success mx-2 rounded-pill'>Paid</span>";
                                    }
                                    ?>

                                </div>
                                <p class="mt-1 mb-0"><?php echo $date ?></p>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="invoice.php?oid=<?php echo $id; ?>" class="btn btn-outline-primary delete-order waves-effect" fdprocessedid="wj1zas">Print</a>
                                <a href="order_list.php?did=<?php echo $id; ?>" class="btn btn-outline-danger delete-order waves-effect" fdprocessedid="wj1zas">Delete Order</a>
                            </div>
                        </div>

                        <!-- Order Details Table -->

                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Order details</h5>
                                    </div>
                                    <div class="card-datatable table-responsive">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <table class="datatables-order-details table dataTable no-footer dtr-column" id="DataTables_Table_0" style="width: 800px;">
                                                <thead>
                                                    <tr>
                                                        <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
                                                        <th class="w-50 sorting_disabled" rowspan="1" colspan="1" style="width: 360px;" aria-label="products">products</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 76px;" aria-label="price">price</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 59px;" aria-label="qty">qty</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 91px;" aria-label="total">total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total = 0;
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        $oid = $data['product_id'];
                                                        $pro_query = mysqli_query($connection, "select * from `tbl_product` where product_id='$oid'");
                                                        while ($prod = mysqli_fetch_array($pro_query)) {
                                                            echo "<tr class='odd'>
                                                            <td class='  control' tabindex='0' style='display: none;'>{$prod['product_name']}</td>
                                                            <td class='sorting_1'>
                                                            <div class='d-flex justify-content-start align-items-center product-name'>
                                                                <div class='avatar-wrapper me-3'>
                                                                    <div class='avatar rounded-2 bg-label-secondary'><img src='" . $prod['product_img'] . "' class='rounded-2'></div>
                                                                </div>
                                                                    <div class='d-flex flex-column'><span class='text-nowrap text-heading fw-medium'>{$prod['product_name']}</span><small class='text-truncate d-none d-sm-block'>Material: Wooden</small></div>";
                                                            echo "</div>";
                                                            echo "  </td>
                                                            <td><span>{$prod['product_price']}</span></td>
                                                            <td><span>{$data['quantity']}</span></td>
                                                            <td>
                                                            <span>";
                                                            $product_total = $prod['product_price'] * $data['quantity'];
                                                            $total += $product_total;
                                                            echo $product_total;
                                                            echo "</span>
                                                        </td>
                                                    </tr>";
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center m-3 p-1">
                                            <div class="order-calculations">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="w-px-100 text-heading">Subtotal:</span>
                                                    <h6 class="mb-0">&#8377;<?php echo $total; ?></h6>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="w-px-100 mb-0">Total:</h6>
                                                    <h6 class="mb-0">&#8377;<?php echo $total; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="card-title mb-4">Customer details</h6>
                                        <div class="d-flex justify-content-start align-items-center mb-4">
                                            <div class="avatar me-2 pe-1">
                                                <img src="<?php echo $cust_img; ?>" alt="Avatar" class="rounded-circle">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="app-user-view-account.html">
                                                    <h6 class="mb-1"><?php echo $cust_name; ?></h6>
                                                </a>
                                                <small>Customer ID: #<?php echo $cust_id; ?></small>
                                            </div>
                                        </div>
                                        <p class=" mb-1">Email: <?php echo $email; ?></p>
                                        <p class=" mb-0">Mobile: <?php echo $contact; ?></p>
                                    </div>
                                </div>

                                <div class="card mb-4">

                                    <div class="card-header d-flex justify-content-between">
                                        <h6 class="card-title m-0">Shipping address</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-4"><?php echo $order_add; ?> <br> <?php echo "$city-$pin_code"; ?> <br><?php echo $country; ?> </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

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
</body>

</html>