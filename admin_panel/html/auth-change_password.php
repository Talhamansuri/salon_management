<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('First you need to login for change your password..!')</script>";
    header("location:auth-login.php");
}
$connection = mysqli_connect("localhost", "root", "", "projectdb");
$id = $_SESSION['id'];
$name = $_SESSION['name'];

$showerror = false;
$showerror1 = false;
$showerror2 = false;
if ($_POST) {
    $query = mysqli_query($connection, "SELECT `password` FROM `tbl_admin` WHERE admin_id='$id'");
    $data = mysqli_fetch_array($query);
    $oldpassword = $data['password'];
    echo $oldpassword;

    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    //check old password are same as databse or not.
    if ($oldpassword == $old_pass) {

        //check new password and confirm password are be same.
        if ($new_pass == $confirm_pass) {
            //check old password and new password are not be same
            if ($new_pass != $old_pass) {
                $update = mysqli_query($connection, "UPDATE `tbl_admin` SET `password`='$new_pass' WHERE admin_id='$id'");
                echo "<script>alert('Password updated successfully');</script>";
                echo "<script>window.location.href='index.php'</script>";
            } else {
                $showerror2 = true;
            }
        } else {
            $showerror1 = true;
        }
    } else {
        $showerror = true;
    }
}


?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Change password Page</title>

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
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.php" class="app-brand-link gap-2">
                            <span>
                                <img src="C:/Users/Furkan/OneDrive/Pictures/logo__1_-removebg-preview.png" />

                            </span>
                            <span class="app-brand-text demo text-heading fw-semibold">Glam salon</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-2">
                        <h4 class="mb-2">Welcome <?php echo $name; ?> 👋</h4>
                        <p class="mb-4">Change your account password</p>

                        <form id="formAuthentication" class="mb-3" method="post" class="needs-validation" novalidate>

                            <div class="mb-3">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" name="old_password" id="oldpassword" class="form-control" name="old_password" placeholder="Enter Your Old Password" autofocus aria-describedby="password" required />
                                            <label for="password">Current Password</label>
                                            <div class="invalid-feedback">
                                                Please enter Current password
                                            </div>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" name="new_password" id="newpassword" class="form-control" name="password" placeholder="Enter Your New Password" aria-describedby="password" required />
                                            <label for="password">New Password</label>
                                            <div class="invalid-feedback">
                                                Please enter New password
                                            </div>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" name="confirm_password" id="confirmpassword" class="form-control" name="password" data-match="#newpassword" data-match-error="Password Do not match" placeholder="Confirm new password" aria-describedby="password" required />
                                            <label for="password">Confirm Password</label>
                                            <div class="invalid-feedback">
                                                Please enter password as New Password
                                            </div>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($showerror) {
                                echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                                        Old Password missmatch — check it out!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }

                            if ($showerror1) {
                                echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                                        confirm Password are missmetch — check it out!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }

                            if ($showerror2) {
                                echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                                        New password must be different from old password — check it out!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }
                            ?>

                            <div class="mb-3 d-flex justify-content-between">
                                <a href="auth-forgot-password.php" class="float-end mb-1">
                                    <span>Forgot Password?</span>
                                </a>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" name="btn_submit">Submit</button>
                            </div>
                            <div class="text-center">
                                <a href="index.php" class="d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                                    Back to homepage
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Login -->
                <img src="../assets/img/illustrations/tree-3.png" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block" />
                <img src="../assets/img/illustrations/auth-basic-mask-light.png" class="authentication-image d-none d-lg-block" alt="triangle-bg" data-app-light-img="illustrations/auth-basic-mask-light.png" data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
                <img src="../assets/img/illustrations/tree.png" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block" />
            </div>
        </div>
    </div>

    <!-- / Content -->

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
</body>

</html>