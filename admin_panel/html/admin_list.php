<?php
$connection = mysqli_connect("localhost", "root", "", "projectdb");
if (isset($_GET['did'])) {

    echo "<script>confirm('Are you sure you want to delete record');</script>";
    //for delete releted image from folder
    $query2 = mysqli_query($connection, "select * from tbl_admin where admin_id={$_GET['did']}");
    $fetch = mysqli_fetch_array($query2);
    $img_path = $fetch['admin_img'];
    unlink($img_path);

    //delete record from table
    mysqli_query($connection, "delete from tbl_admin where admin_id='$_GET[did]'");
} else {
    mysqli_error($connection);
}

?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin List</title>

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
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Admins /</span> Admin List</h4>

                        <hr class="my-5" />

                        <!-- Bootstrap Table with Header - Light -->
                        <div class="card">
                            <div class="table-responsive text-nowrap m-4 mt-5">
                                <table class="table" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>Admin name</th>
                                            <th>Contact</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-1">
                                        <?php
                                        $query = mysqli_query($connection, "select * from tbl_admin");
                                        while ($col = mysqli_fetch_array($query)) {
                                            echo "<tr>
                                            <td>#{$col['admin_id']}</td>
                                            <td class='sorting_1'>
                                                <div class='d-flex justify-content-start align-items-center product-name'>
                                                    <div class='avatar-wrapper me-3'>
                                                        <div class='avatar rounded-2 bg-label-secondary'><img src='{$col["admin_img"]}' class='rounded-2'></div>
                                                    </div>
                                                    <div class='d-flex flex-column'><span class='text-nowrap text-heading fw-medium'>{$col['first_name']} {$col['last_name']}</span><small class='text-truncate d-none d-sm-block'>{$col['email']}</small></div>
                                                </div>
                                            </td>
                                            <td>{$col['contact']}</td>
                                            <td>{$col['gender']}</td>
                                            <td>{$col['DOB']}</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                        <i class='mdi mdi-dots-vertical'></i>
                                                    </button>
                                                    <div class='dropdown-menu'>
                                                        <a class='dropdown-item' href='account-settings.php?uid=$col[0]'><i class='mdi mdi-pencil-outline me-1'></i> Edit</a>
                                                        <a class='dropdown-item' href='admin_list.php?did=$col[0]'><i class='mdi mdi-trash-can-outline me-1'></i> Delete</a>
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

    <!-- Modal -->
    <div class="modal fade" id="datamodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Details of Admin</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr data-dt-row="8" data-dt-column="2">
                                <td>Admin :</td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="avatar-wrapper me-3">
                                            <div class="avatar rounded-2 bg-label-secondary"><img src="../../assets/img/ecommerce-images/product-9.png" alt="Product-9" class="rounded-2"></div>
                                        </div>
                                        <div class="d-flex flex-column"><span class="text-nowrap text-heading fw-medium">Air Jordan</span><small class="text-truncate d-none d-sm-block">Air Jordan is a line of basketball shoes produced by Nike</small></div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-dt-row="8" data-dt-column="3">
                                <td>category:</td>
                                <td>
                                    <h6 class="text-truncate d-flex align-items-center mb-0"><span class="avatar-sm rounded-circle d-flex justify-content-center align-items-center bg-label-info me-2"><i class="mdi mdi-shoe-sneaker"></i></span>Shoes</h6>
                                </td>
                            </tr>
                            <tr data-dt-row="8" data-dt-column="4">
                                <td>stock:</td>
                                <td><span class="text-truncate"><label class="switch switch-primary switch-sm"><input type="checkbox" class="switch-input" id="switch"><span class="switch-toggle-slider"><span class="switch-off"></span></span></label><span class="d-none">Out_of_Stock</span></span></td>
                            </tr>
                            <tr data-dt-row="8" data-dt-column="5">
                                <td>sku:</td>
                                <td><span>31063</span></td>
                            </tr>
                            <tr data-dt-row="8" data-dt-column="6">
                                <td>price:</td>
                                <td><span>$125</span></td>
                            </tr>
                            <tr data-dt-row="8" data-dt-column="7">
                                <td>qty:</td>
                                <td><span>942</span></td>
                            </tr>
                            <tr data-dt-row="8" data-dt-column="8">
                                <td>status:</td>
                                <td><span class="badge rounded-pill bg-label-danger" text-capitalized="">Inactive</span></td>
                            </tr>
                            <tr data-dt-row="8" data-dt-column="9">
                                <td>Actions:</td>
                                <td>
                                    <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="z2h187"><i class="mdi mdi-pencil-outline"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="9wl71"><i class="mdi mdi-dots-vertical me-2"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:0;" class="dropdown-item">View</a><a href="javascript:0;" class="dropdown-item">Suspend</a></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
</html>