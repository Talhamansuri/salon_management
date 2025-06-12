<?php

$connection = mysqli_connect("localhost", "root", "", "projectdb");

$id = $_GET['uid'];
$query = mysqli_query($connection, "select * from tbl_employee where emp_id=$id");
$data = mysqli_fetch_array($query);

$fname = $data['fname'];
$lname = $data['lname'];
$gender = $data['gender'];
$email = $data['email'];
$contact = $data['contact'];
$address = $data['address'];
$salary = $data['salary'];
$designation = $data['designation'];

if (isset($_POST['btn_submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];

    $update = mysqli_query($connection, "UPDATE `tbl_employee` SET `fname`='$fname',`lname`='$lname',`gender`='$gender',`email`='$email',`contact`='$contact',`address`='$address',`designation`='$designation',`salary`='$salary' WHERE emp_id=$id");
    if ($update) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href='employee_list.php';</script>";
    } else {
        mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Update Employee</title>

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
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Employee Form</h4>

                        <!-- Basic Layout -->
                        <div class="row">
                            <!-- Merged -->
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Update Employees</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="frm1" method="post" class="needs-validation" novalidate>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control" id="floatingInput" placeholder="John" aria-describedby="floatingInputHelp" required />
                                                        <label for="floatingInput">First Name</label>
                                                        <div class="invalid-feedback">
                                                            Please Enter First Name
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control" id="floatingInput" placeholder="die" aria-describedby="floatingInputHelp" required />
                                                        <label for="floatingInput">Last Name</label>
                                                        <div class="invalid-feedback">
                                                            Please Enter Last Name
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md mb-3">
                                                <small class="text-light fw-medium d-block">Gender</small>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Male" <?php if ($gender == "Male") { echo "checked"; }?> />
                                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Female" <?php if ($gender == "Female") { echo "checked"; }?> required />
                                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                                    <div class="invalid-feedback">
                                                        Please select gender
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="floatingInput" placeholder="name@example.com" aria-describedby="floatingInputHelp" required />
                                                <label for="floatingInput">Enter Email</label>
                                                <div class="invalid-feedback">
                                                    Please enter valid Email Address
                                                </div>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="tel" name="contact" value="<?php echo $contact; ?>" class="form-control" id="floatingInput" placeholder="Phone number" aria-describedby="floatingInputHelp" required />
                                                <label for="floatingInput">Enter Phone number</label>
                                                <div class="invalid-feedback">
                                                    Please Enter Valid Phone number
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <textarea name="address" class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Enter your Adreess in details" required><?php echo $address; ?></textarea>
                                                <label for="exampleFormControlTextarea1">Address</label>
                                                <div class="invalid-feedback">Please enter Address </div>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <select class="form-select" id="exampleFormControlSelect1" name="designation" aria-label="Default select example" required>
                                                    <option value="Manager" <?php if ($designation == "Manager") { echo "selected"; }?>>Manager</option>
                                                    <option value="Sales man" <?php if ($designation == "Sales Man") { echo "selected"; }?>>Sales man</option>
                                                    <option value="Employee" <?php if ($designation == "Employee") { echo "selected"; }?>>Employee</option>
                                                    <option value="Clerk" <?php if ($designation == "Clerk") { echo "selected"; }?>>Clerk</option>
                                                </select>
                                                <label for="exampleFormControlSelect1">Select Designation</label>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="number" name="salary" value="<?php echo $salary; ?>"  class="form-control" id="floatingInput" placeholder="ex. 12000" aria-describedby="floatingInputHelp" required />
                                                <label for="floatingInput">Enter Salary</label>
                                                <div class="invalid-feedback">
                                                    Please enter salary
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
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                                <div class="text-body mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by
                                    <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">ThemeSelection</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeselection.com/license/" class="footer-link me-3" target="_blank">License</a>
                                    <a href="https://themeselection.com/" target="_blank" class="footer-link me-3">More Themes</a>

                                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-3">Documentation</a>

                                    <a href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free/issues" target="_blank" class="footer-link">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
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