<?php
session_start();
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" id="alert" role="alert">
        OTP has been send successfully on your Email..!
      </div>';
      unset($_SESSION['success']);
}



if (isset($_POST['btn_send'])) {

    $user_otp = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit4'] . $_POST['digit5'] . $_POST['digit6'];
    if ($user_otp == $_SESSION['otp']) {
        header("location:change_password.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
        OTP does not match - check it out!
      </div>';
    }
}


?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Forgot Password</title>

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
    <style>
        .otp-textbox {
            height: 50px;
            width: 45px;
            margin-right: 2px;
            font-size: 20px;
            text-align: center;
            scrollbar-width: none;
        }
    </style>
</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Logo -->
                <div class="card p-2">
                    <!-- Forgot Password -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                            </span>
                            <span class="app-brand-text demo text-heading fw-semibold">Glam Salon</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="card-body mt-2">
                        <h4 class="mb-2">OTP varification 🔒</h4>
                        <p class="mb-4">Enter your varification code we sent to your email.</p>
                        <form id="formAuthentication" class="mb-3" method="post">
                            <div class="otp_input text-start mb-3 mt-4">
                                <label for="digit">Type your 6 digit security code</label>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
                                    <input type="text" maxlength="1" oninput="autofocusNext(this,'digit2')" name="digit1" class="form-control otp-textbox" autofocus>
                                    <input type="text" maxlength="1" oninput="autofocusNext(this,'digit3')" name="digit2" class="form-control otp-textbox">
                                    <input type="text" maxlength="1" oninput="autofocusNext(this,'digit4')" name="digit3" class="form-control otp-textbox">
                                    <input type="text" maxlength="1" oninput="autofocusNext(this,'digit5')" name="digit4" class="form-control otp-textbox">
                                    <input type="text" maxlength="1" oninput="autofocusNext(this,'digit6')" name="digit5" class="form-control otp-textbox">
                                    <input type="text" maxlength="1" class="form-control otp-textbox" name="digit6">
                                </div>
                                <p id="timer" style="text-align:right">59 seconds remaining</p>

                            </div>
                            <button type="submit" name="btn_send" class="btn btn-primary d-grid w-100">Submit</button>
                            <div class="text-center text-muted mb-2 mt-3" style="display:none">
                                Didn’t get the code ? <a href="#" class="text-primary fw-bold text-decoration-none">Resend</a>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Forgot Password -->
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
</body>
    <script>
        function autofocusNext(current, nextinput) {
            if (current.value.length === current.maxLength) {
                document.getElementsByName(nextinput)[0].focus();
            }
        }
    </script>

<script>
    var count = 59;
    var timer = setInterval(function() {
        count--;
        if (count == 0) {
            clearInterval(timer);
            document.getElementById("timer").innerHTML = "Time's up!";
            document.querySelector(".text-muted").style.display = "block";
            document.querySelector("#timer").style.display = "none";
        } else {
            document.getElementById("timer").innerHTML = count + " seconds remaining";
        }
    }, 1000);
</script>


<script>
    var alertElement = document.getElementById('alert');
    setTimeout(function() {
        alertElement.style.display = 'none';
    }, 5000);
</script>

</html>