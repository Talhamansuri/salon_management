<?php

$connection = mysqli_connect("localhost", "root", "", "projectdb");
$alert = false;


if (isset($_POST['btn_submit'])) {

    $filename = $_FILES["img_path"]["name"];
    $temp = $_FILES["img_path"]["tmp_name"];
    $folder = "images/service/" . $filename;
    move_uploaded_file($temp, $folder);

    $name = $_POST['service_name'];
    $type = $_POST['service_type'];
    $s_category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $query = mysqli_query($connection, "INSERT INTO `tbl_service` (`service_id`, `service_name`, `description`, `service_charge`,'service_type', `service_img`, `category_id`) VALUES (NULL, '$name', '$description', '$price','$type', '$folder', '$s_category')");
    if ($query) {
        $alert = true;
    } else {
        echo "<script>alert('Record added failed...!');</script>";
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
                                                        Data submitted Successfully — check it out!
                                                </div></div>";
                                    }

                                    ?>
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Add Service</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="frm1" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="text" name="service_name" class="form-control" id="floatingInput" placeholder="Service name" aria-describedby="floatingInputHelp" required />
                                                <label for="floatingInput">Service Name</label>
                                                <div class="invalid-feedback">
                                                    Please Enter Service name
                                                </div>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="service_type" aria-label="Default select example" required>
                                                    <option value="Male" selected >Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <textarea class="form-control h-px-100" name="description" id="exampleFormControlTextarea1" placeholder="write description here..." required></textarea>
                                                <label for="exampleFormControlTextarea1">Description</label>
                                                <div class="invalid-feedback">
                                                    Please enter Description
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="category" aria-label="Default select example" required>
                                                    <option value="" selected disabled>Select Option for Category</option>
                                                    <?php
                                                    $conn = mysqli_connect("localhost", "root", "", "projectdb");
                                                    $query = mysqli_query($conn, "select * from tbl_service_category");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        echo "<option value='$row[0]'>$row[1]</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="exampleFormControlSelect1">Select Category</label>
                                                <div class="invalid-feedback">
                                                    Please Select category
                                                </div>
                                            </div>

                                            <div class="input-group mb-4">
                                                <input type="file" name="img_path" class="form-control" id="inputGroupFile02" required />
                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                <div class="invalid-feedback">
                                                    Please upload file
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-3">
                                                <input type="number" name="price" class="form-control" id="floatingInput" placeholder="Price" aria-describedby="floatingInputHelp" required />
                                                <label for="floatingInput">Price</label>
                                                <div class="invalid-feedback">
                                                    Pleas Enter Price
                                                </div>
                                            </div>
                                            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
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