<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['btn_send'])) {
    $user_email = $_POST['email'];
    $connection = mysqli_connect("localhost", "root", "", "projectdb");
    $query = mysqli_query($connection, "SELECT * FROM `tbl_customer` WHERE email='$user_email'");
    $count = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);
    $userid = $data['customer_id'];
    $user_name = $data['first_name'] . $data['last_name'];
    $user_email = $data['email'];


    if ($count > 0) {

        $otp = mt_rand(100000, 999999);

        //send email
        $mail = new PHPMailer(true);
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'glamsalon001@gmail.com';
        $mail->Password   = 'galr flnp gxly btka';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('glamsalon001@gmail.com', 'Glam Salon');
        $mail->addAddress($user_email , $user_name);     //Add a recipient

        //Content
        $mail->isHTML(true);
        //Set email format to HTML
        $mail->Subject = 'Password Reset OTP';
        $mail->Body    = '<h4>Hey furkan,</h4>
        We got request to reset your password for your account. To proceed with the password reset request, Please use the following One-time Password(OTP):
        <b><br/><br/>OTP :' . $otp . '</b><br/><br/>
        Please note that this otp is valid for 1 minute and only can be use once.<br/>If you did not initiate this password reset request, please desregard this email.<br/><br/><br/>
        Best regards,<br/>Glam salon';
        $mail->send();
        $_SESSION['otp'] = $otp;
        $_SESSION['userid'] = $userid;
        $_SESSION['username'] = $user_name;
        $_SESSION['user_mail'] = $user_email;
        echo "<script>alert('Email send on your register email address')</script>";
        echo "<script>window.location.href='otp_varification.php'</script>";
        exit();
    } else {
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Forgot Password</title>
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
                <h2>Forgot Password</h2>
                <ul>
                    <li>Home</li>
                    <li class="active">Forgot Password</li>
                </ul>
            </div>
        </div>
        <div class="shop">
            <div class="container" style="max-width: 50%; margin: auto;">
                <div class="checkout">
                    <div class="container">
                        <div class="login-container" style="width: 80%;">
                            <form method="post" class="validated-form cta__form__detail">
                                <div class="checkout__form">
                                    <div class="checkout__form__contact">
                                        <div class="checkout__form__contact__title">
                                            <h5 class="checkout-title">Forgot Password? 🔒</h5>
                                            <p class="mb-4"><br/>Enter your email and we'll send you instructions<br/> to reset your password</p>
                                        </div>
                                        <div class="input-validator">
                                            <label>Email<span>*</span>
                                                <input type="email" name="email" placeholder="Enter your email" required="required" />
                                            </label>
                                        </div>
                                        <button type="submit" style="width:100%;" name="btn_send" class="btn -red mt-1">Send email</button>
                                        <a href="login.php" style="width:100%;" class="btn -white mt-3">Back to login</a>
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