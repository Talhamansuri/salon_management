<?php

$connection = mysqli_connect("localhost", "root", "", "projectdb");
$alert = false;
$alert_message = "";

if (isset($_POST['btn_submit'])) {
    $service_names = $_POST['service_name'] ?? [];
    $service_types = $_POST['service_type'] ?? [];
    $descriptions = $_POST['description'] ?? [];
    $categories = $_POST['category'] ?? [];
    $prices = $_POST['price'] ?? [];
    $files = $_FILES['img_path'] ?? null;

    $success_count = 0;
    $failed_count = 0;

    for ($i = 0; $i < count($service_names); $i++) {
        if (empty($service_names[$i])) {
            continue;
        }

        $folder = "images/service/default.jpg";
        if (isset($files['name'][$i]) && !empty($files['name'][$i])) {
            $filename = $files['name'][$i];
            $temp = $files['tmp_name'][$i];
            $folder = "images/service/" . time() . "_" . $filename;
            
            if (!move_uploaded_file($temp, $folder)) {
                $folder = "images/service/default.jpg";
            }
        }

        $name = mysqli_real_escape_string($connection, $service_names[$i]);
        $type = mysqli_real_escape_string($connection, $service_types[$i]);
        $description = mysqli_real_escape_string($connection, $descriptions[$i]);
        $category = mysqli_real_escape_string($connection, $categories[$i]);
        $price = mysqli_real_escape_string($connection, $prices[$i]);

        $query = mysqli_query($connection, "INSERT INTO `tbl_service` (`service_id`, `service_name`, `description`, `service_charge`, `service_type`, `service_img`, `category_id`) VALUES (NULL, '$name', '$description', '$price', '$type', '$folder', '$category')");
        
        if ($query) {
            $success_count++;
        } else {
            $failed_count++;
        }
    }

    if ($success_count > 0) {
        $alert = true;
        $alert_message = "$success_count service(s) added successfully!";
        if ($failed_count > 0) {
            $alert_message .= " ($failed_count failed)";
        }
    } elseif ($failed_count > 0) {
        echo "<script>alert('Failed to add services!');</script>";
    }
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Service Form</title>

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
    <script src="../assets/js/config.js"></script>
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
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Services /</span> Service Form</h4>

                        <!-- Basic Layout -->
                        <div class="row">
                            <!-- Merged -->
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <?php

                                    if ($alert == true) {
                                        echo "<div id='alert' class='card-header'><div class='alert alert-success alert-dismissible' role='alert'>
                                                        " . $alert_message . " — check it out!
                                                </div></div>";
                                    }

                                    ?>
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Add Service</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="frm1" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                                            <!-- Table for Multiple Entries -->
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered" id="serviceTable" style="border: 2px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                                                    <thead>
                                                        <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                                            <th style="text-align: center; padding: 12px; color: white;">#</th>
                                                            <th style="padding: 12px; color: white;">Service Name</th>
                                                            <th style="padding: 12px; color: white;">Service Type</th>
                                                            <th style="padding: 12px; color: white;">Description</th>
                                                            <th style="padding: 12px; color: white;">Category</th>
                                                            <th style="padding: 12px; color: white;">Image</th>
                                                            <th style="padding: 12px; color: white;">Price</th>
                                                            <th style="text-align: center; padding: 12px; color: white;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        <tr class="service-row" style="background-color: #f8f9fa;">
                                                            <td class="row-number" style="text-align: center; font-weight: bold; background-color: #e9ecef;">1</td>
                                                            <td><input type="text" name="service_name[]" class="form-control form-control-sm" placeholder="Service name" required /></td>
                                                            <td>
                                                                <select name="service_type[]" class="form-select form-select-sm" required>
                                                                    <option value="">Select</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </td>
                                                            <td><textarea name="description[]" class="form-control form-control-sm" placeholder="Description" rows="2" required></textarea></td>
                                                            <td>
                                                                <select name="category[]" class="form-select form-select-sm" required>
                                                                    <option value="">Select Category</option>
                                                                    <?php
                                                                    $conn = mysqli_connect("localhost", "root", "", "projectdb");
                                                                    $query = mysqli_query($conn, "select * from tbl_service_category");
                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                        echo "<option value='$row[0]'>$row[1]</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="file" name="img_path[]" class="form-control form-control-sm" accept="image/*" /></td>
                                                            <td><input type="number" name="price[]" class="form-control form-control-sm" placeholder="Price" min="0" step="0.01" required /></td>
                                                            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeServiceRow(this)"><i class="mdi mdi-delete"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Add Row Button & Submit -->
                                            <div class="d-flex gap-2 mt-4">
                                                <button type="button" class="btn btn-info" onclick="addServiceRow()">
                                                    <i class="mdi mdi-plus-circle"></i> Add Service
                                                </button>
                                                <button type="submit" name="btn_submit" class="btn btn-success">
                                                    <i class="mdi mdi-check-circle"></i> Submit All Services
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <!-- Multiple Service Entry Script -->
    <script>
        function addServiceRow() {
            const tableBody = document.getElementById('tableBody');
            const rowCount = tableBody.querySelectorAll('.service-row').length + 1;
            
            const newRow = document.createElement('tr');
            newRow.className = 'service-row';
            newRow.style.backgroundColor = '#f8f9fa';
            newRow.innerHTML = `
                <td class="row-number" style="text-align: center; font-weight: bold; background-color: #e9ecef;">${rowCount}</td>
                <td><input type="text" name="service_name[]" class="form-control form-control-sm" placeholder="Service name" required /></td>
                <td>
                    <select name="service_type[]" class="form-select form-select-sm" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><textarea name="description[]" class="form-control form-control-sm" placeholder="Description" rows="2" required></textarea></td>
                <td>
                    <select name="category[]" class="form-select form-select-sm" required>
                        <option value="">Select Category</option>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "projectdb");
                        $query = mysqli_query($conn, "select * from tbl_service_category");
                        while ($row = mysqli_fetch_array($query)) {
                            echo "<option value='$row[0]'>$row[1]</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><input type="file" name="img_path[]" class="form-control form-control-sm" accept="image/*" /></td>
                <td><input type="number" name="price[]" class="form-control form-control-sm" placeholder="Price" min="0" step="0.01" required /></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="removeServiceRow(this)"><i class="mdi mdi-delete"></i></button></td>
            `;
            tableBody.appendChild(newRow);
            updateRowNumbers();
        }

        function removeServiceRow(button) {
            const row = button.parentNode.parentNode;
            const tableBody = document.getElementById('tableBody');
            
            if (tableBody.querySelectorAll('.service-row').length > 1) {
                row.remove();
                updateRowNumbers();
            } else {
                alert('At least one service is required!');
            }
        }

        function updateRowNumbers() {
            const rows = document.querySelectorAll('.service-row');
            rows.forEach((row, index) => {
                row.querySelector('.row-number').textContent = index + 1;
            });
        }
    </script>

    <!-- Custom Styles -->
    <style>
        .form-control-sm,
        .form-select-sm {
            padding: 0.375rem 0.5rem;
            font-size: 0.875rem;
        }

        .table-hover tbody tr:hover {
            background-color: #e7f3ff !important;
            transition: background-color 0.3s ease;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 8px;
        }

        .btn {
            border-radius: 5px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }

            .form-control-sm,
            .form-select-sm {
                padding: 0.25rem 0.4rem;
                font-size: 0.75rem;
            }
        }
    </style>

    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script>
        var alertElement = document.getElementById('alert');
        setTimeout(function() {
            alertElement.style.display = 'none';
        }, 5000);
    </script>
</body>

</html>