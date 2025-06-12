<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (!isset($_SESSION['customer_id'])) {
    echo "<script>alert('First you need to login')</script>";
    echo "<script>window.location.href='login.php'</script>";
  }
  

$id = $_SESSION['userid'];
$name = $_SESSION['username'];

if (isset($_POST['btn_submit'])) {
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    $old_pass_query=mysqli_query($connection,"SELECT `password` FROM `tbl_customer` WHERE customer_id=$id");
    $data=mysqli_fetch_array($old_pass_query);
    $old_pass=$data['password'];

    //check new password and confirm password are be same.
    if ($new_pass == $confirm_pass) {
        //check old password and new password are not be same
        if ($new_pass == $old_pass) {
            echo "<script>alert('you can not able to use your old password');</script>";
        } else {
            $update = mysqli_query($connection, "UPDATE `tbl_customer` SET `password`='$new_pass' WHERE customer_id='$id'");
            echo "<script>alert('Password updated successfully !');</script>";
            unset($_SESSION['userid']);
            unset($_SESSION['username']);
            unset($_SESSION['user_mail']);

            echo "<script>window.location.href='login.php'</script>";
        }
    } else {
        echo "<script>alert('New password and confirm password did not match check it!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Change Password</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Spartan:wght@300;400;500;700;900&amp;display=swap" />
    <link rel="shortcut icon" type="image/png" href="assets/images/fav.png" />
    <!--build:css assets/css/styles.min.css-->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../../../cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="assets/css/slick.min.css" />
    <link rel="stylesheet" href="assets/css/fontawesome.css" />
    <link rel="stylesheet" href="assets/css/jquery.modal.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-drawer.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <!--endbuild-->
</head>

<body>

    <!-- Menu -->
    <?php
    include "navbar.php";
    ?>
    <!-- / Menu -->

    <div id="content">
        <div class="breadcrumb">
            <div class="container">
                <h2>Change Password</h2>
                <ul>
                    <li>Home</li>
                    <li class="active">Change Password</li>
                </ul>
            </div>
        </div>
        <div class="shop">
            <div class="container" style="max-width: 50%; margin: auto;">
                <div class="checkout">
                    <div class="container">
                        <div class="login-container">
                            <form method="post" class="validated-form cta__form__detail">
                                <div class="checkout__form">
                                    <div class="checkout__form__contact">
                                        <div class="checkout__form__contact__title">
                                            <h4 class="mb-2">Welcome back <?php echo $name; ?> 👋</h4>
                                            <h5 class="checkout-title mb-4 mt-2">Change your account password</h5>
                                        </div>
                                        <div class="input-validator">
                                            <label>New Password<span>*</span>
                                                <input type="text" name="new_password" placeholder="Password" required="required" />
                                            </label>
                                        </div>
                                        <div class="input-validator">
                                            <label>Confirm Password<span>*</span>
                                                <input type="text" name="confirm_password" placeholder="Password" required="required" />
                                            </label>
                                        </div>
                                        <button type="submit" style="width:100%;" name="btn_submit" class="btn -red mt-3">Change password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="instagram-two">
            <div class="instagram-two-slider"><a class="slider-item" href="https://www.instagram.com/"><img src="assets/images/instagram/InstagramTwo/1.png" alt="Instagram image" /></a><a class="slider-item" href="https://www.instagram.com/"><img src="assets/images/instagram/InstagramTwo/2.png" alt="Instagram image" /></a><a class="slider-item" href="https://www.instagram.com/"><img src="assets/images/instagram/InstagramTwo/3.png" alt="Instagram image" /></a><a class="slider-item" href="https://www.instagram.com/"><img src="assets/images/instagram/InstagramTwo/4.png" alt="Instagram image" /></a><a class="slider-item" href="https://www.instagram.com/"><img src="assets/images/instagram/InstagramTwo/5.png" alt="Instagram image" /></a><a class="slider-item" href="https://www.instagram.com/"><img src="assets/images/instagram/InstagramTwo/6.png" alt="Instagram image" /></a>
            </div>
        </div>

        <!-- footer -->
        <?php
        include "footer.php";
        ?>
        <!-- / footer -->

        <!-- offcanvas menu -->
        <?php
        include "off_canvas.php";
        ?>
        <!-- / off_canvas -->

    </div>
    <!--build:js assets/js/main.min.js-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/parallax.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/jquery.modal.min.js"></script>
    <script src="assets/js/bootstrap-drawer.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/main.min.js"></script>
    <!--endbuild-->
</body>

</html>