<?php

session_start();


if (!isset($_SESSION['customer_id'])) {
    echo "<script>alert('First you need to log-in for book appointment')</script>";
    echo "<script>window.location.href='login.php'</script>";
}

$alert = false;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (isset($_POST['btn_submit'])) {

    $service_id = $_POST['service'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $messege = $_POST['message'];
    $query = mysqli_query($connection, "INSERT INTO `tbl_appointment` (`appointment_id`, `first_name`, `last_name`, `gender`, `email`, `contact`,`service`, `message`, `appointment_date`, `status`) VALUES (NULL, '$fname', '$lname', '$gender', '$email', '$contact','$service_id', '$messege ', '$date', 'Pending')");
    if ($query) {

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
        $mail->addAddress($email, $fname);     //Add a recipient

        //Content
        $mail->isHTML(true);
        //Set email format to HTML
        $mail->Subject = "Appointment Confirmation";
        $mail->Body    = "<h4>Dear " . $fname . ",</h4><br/>
        Thank you for booking appointment at Glam salon! we`re excited to have you as our valued customer, Here are the details of your appointmnt,<br/>
        <br/>
        Date :" . $date . "<br/>
        Service :" . $service_id . "<br/>
        Location : Maninagar<br/><br/>
        We kindly request that you arrive 10 minutes prior to your appointment to ensure smooth and relaxing experience. if you need to reshedule or cancel your appointment,
        please let us know atleast 24 hours in advance.
        <br/>
        Should you have any further inquiries, don't hesitate to contact us.<br/><br/>
        Best regards,<br/>Glam salon Team";
        $mail->send();
        echo "<script>alert('Your appointment request sent successfully...!');</script>";
    } else {
        echo "<script>alert('Record added failed...!');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Appointment</title>
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
                <h2>Appointment</h2>
                <ul>
                    <li>Home</li>
                    <li class="active">appointment</li>
                </ul>
            </div>
        </div>
        <div class="shop">
            <div class="container">
                <div class="login-container">
                    <div class="checkout">
                        <div class="container">
                            <form method="post" class="validated-form cta__form__detail">
                                <div class="checkout__form">
                                    <div class="checkout__form__shipping">
                                        <div class="checkout__form__contact__title">
                                            <h4 class="checkout-title" style="text-align: center;">Book Your Appointment Here!</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="input-validator">
                                                    <label>First name <span>*</span>
                                                        <input type="text" name="firstName" required="required" />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-validator">
                                                    <label>Last name<span>*</span>
                                                        <input type="text" name="lastName" required="required" />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Email <span>*</span>
                                                        <input type="email" name="email" required="required" />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>contact<span>*</span>
                                                        <input type="number" name="contact" required="required" />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Select Gender <span>*</span>
                                                        <select class="customed-select required" name="gender" required="required">
                                                            <option value="" hidden="hidden">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Select Services <span>*</span>
                                                        <select class="customed-select required" name="service" required="required">
                                                            <option value="" hidden="hidden">Select your service</option>
                                                            <?php
                                                            $service_query = mysqli_query($connection, "select * from tbl_service");

                                                            while ($fetch_service = mysqli_fetch_array($service_query)) {
                                                                echo "<option value='" . $fetch_service['service_id'] . "'>" . $fetch_service['service_name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Appointment Date<span>*</span>
                                                        <input type="datetime-local" id="datetime" name="date" min="" max="" step="600" required="required" />

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Message
                                                        <textarea type="text" placeholder="Note about your appointment (optional)" name="message"></textarea>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="btn_submit" style="width: 100%;" class="btn -red">Book appointment</button>
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

        <!-- Quick Cart -->
        <?php
        include "quick_cart.php";
        ?>
        <!-- / Quick Cart -->

        <!-- mobile menu -->
        <?php
        include "off_canvas.php";
        ?>
        <!-- / mobile menu -->


        <div class="modal" id="quick-view-modal">
            <div class="product-quickview">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="product-detail__slide-one">
                            <div class="slider-wrapper">
                                <div class="slider-item"><img src="assets/images/product/1.png" alt="Product image" /></div>
                                <div class="slider-item"><img src="assets/images/product/2.png" alt="Product image" /></div>
                                <div class="slider-item"><img src="assets/images/product/3.png" alt="Product image" /></div>
                                <div class="slider-item"><img src="assets/images/product/4.png" alt="Product image" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="product-detail__content">
                            <div class="product-detail__content__header">
                                <h5>eyes</h5>
                                <h2>The expert mascaraa</h2>
                            </div>
                            <div class="product-detail__content__header__comment-block">
                                <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                                <p>03 review</p><a href="#">Write a reviews</a>
                            </div>
                            <h3>$35.00</h3>
                            <div class="divider"></div>
                            <div class="product-detail__content__footer">
                                <ul>
                                    <li>Brand:gucci
                                    </li>
                                    <li>Product code: PM 01
                                    </li>
                                    <li>Reward point: 30
                                    </li>
                                    <li>Availability: In Stock</li>
                                </ul>
                                <div class="product-detail__colors"><span>Color:</span>
                                    <div class="product-detail__colors__item" style="background-color: #8B0000"></div>
                                    <div class="product-detail__colors__item" style="background-color: #4169E1"></div>
                                </div>
                                <div class="product-detail__controller">
                                    <div class="quantity-controller -border -round">
                                        <div class="quantity-controller__btn -descrease">-</div>
                                        <div class="quantity-controller__number">2</div>
                                        <div class="quantity-controller__btn -increase">+</div>
                                    </div>
                                    <div class="add-to-cart -dark"><a class="btn -round -red" href="#"><i class="fas fa-shopping-bag"></i></a>
                                        <h5>Add to cart</h5>
                                    </div>
                                    <div class="product-detail__controler__actions"></div><a class="btn -round -white" href="#"><i class="fas fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <script>
        // Get current date and time
        var currentDate = new Date();

        // Set minimum date to tomorrow
        var minDate = new Date(currentDate.getTime() + 24 * 60 * 60 * 1000).toISOString().split("T")[0];

        // Set maximum date to 5 days from now
        var maxDate = new Date(currentDate.getTime() + 5 * 24 * 60 * 60 * 1000).toISOString().split("T")[0];

        // Set specified time slot (e.g., from 9 AM to 5 PM)
        var minTime = "09:00";
        var maxTime = "20:00";

        // Get current time and adjust the minimum time accordingly
        var currentTime = currentDate.toTimeString().split(":").slice(0, 2).join(":");
        var adjustedMinTime = currentTime > minTime ? currentTime : minTime;

        // Set the minimum and maximum attributes of the datetime input
        document.getElementById("datetime").setAttribute("min", minDate + "T" + adjustedMinTime);
        document.getElementById("datetime").setAttribute("max", maxDate + "T" + maxTime);

        // Disable dates beyond the next 5 days
        document.getElementById("datetime").addEventListener("input", function() {
            var selectedDate = new Date(this.value);
            if (selectedDate > new Date(currentDate.getTime() + 5 * 24 * 60 * 60 * 1000)) {
                this.setCustomValidity("Please select a date within the next 5 days.");
            } else {
                this.setCustomValidity("");
            }
        });

        // Disable times outside the specified time slot
        document.getElementById("datetime").addEventListener("input", function() {
            var selectedTime = this.value.split("T")[1];
            if (selectedTime < minTime || selectedTime > maxTime) {
                this.setCustomValidity("Please select a time between 9:00 AM and 5:00 PM.");
            } else {
                this.setCustomValidity("");
            }
        });

        // Disable selecting previous time from today
        document.getElementById("datetime").addEventListener("input", function() {
            var selectedDate = new Date(this.value);
            var selectedTime = this.value.split("T")[1];
            if (selectedDate.toDateString() === currentDate.toDateString() && selectedTime < currentTime) {
                this.setCustomValidity("Please select a time not earlier than the current time.");
            } else {
                this.setCustomValidity("");
            }
        });
    </script>
</body>

</html>