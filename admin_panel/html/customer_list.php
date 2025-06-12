<?php
$connection = mysqli_connect("localhost", "root", "", "projectdb");
if (isset($_GET['did'])) {

    //for delete releted image from folder
    $query2 = mysqli_query($connection, "select * from tbl_customer where customer_id={$_GET['did']}");
    $fetch = mysqli_fetch_array($query2);
    $img_path = $fetch['cust_img'];
    unlink($img_path);

    mysqli_query($connection, "delete from tbl_customer where customer_id='$_GET[did]'");
} else {
    mysqli_error($connection);
}

?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Customer List</title>

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
    <script>
        function redirect() {
            window.location.href = "add_customer.php";
        }
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
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Customers /</span> Customer List</h4>

                        <hr class="my-5" />

                        <!-- Bootstrap Table with Header - Light -->
                        <div class="card">
                            <div class="table-responsive text-nowrap m-4 mt-5">
                                <table class="table" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>Customer name</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Contact</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-1">
                                        <?php
                                        $query = mysqli_query($connection, "select * from tbl_customer");
                                        while ($customer_details = mysqli_fetch_array($query)) {
                                            echo "<tr>
                                            <td>#{$customer_details['customer_id']}</td>
                                            <td class='sorting_1'>
                                                <div class='d-flex justify-content-start align-items-center product-name'>
                                                    <div class='avatar-wrapper me-3'>
                                                        <div class='avatar rounded-2 bg-label-secondary'><img src='{$customer_details["cust_img"]}' class='rounded-2'></div>
                                                    </div>
                                                    <div class='d-flex flex-column'><span class='text-nowrap text-heading fw-medium'>{$customer_details['first_name']} {$customer_details['last_name']}</span><small class='text-truncate d-none d-sm-block'>{$customer_details['email']}</small></div>
                                                </div>
                                            </td>
                                            <td>{$customer_details['gender']}</td>
                                            <td>{$customer_details['DOB']}</td>
                                            <td>{$customer_details['contact']}</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                        <i class='mdi mdi-dots-vertical'></i>
                                                    </button>
                                                    <div class='dropdown-menu'>
                                                        <a class='dropdown-item' href='update_customer.php?uid={$customer_details['customer_id']}'><i class='mdi mdi-pencil-outline me-1'></i> Edit</a>
                                                        <a class='dropdown-item' href='customer_list.php?did={$customer_details['customer_id']}'><i class='mdi mdi-trash-can-outline me-1'></i> Delete</a>
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

<!-- datatabless jquery cdn link-->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</html>