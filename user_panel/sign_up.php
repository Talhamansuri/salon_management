<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (isset($_POST['btn_submit'])) {

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];

    $query = mysqli_query($connection, "INSERT INTO `tbl_customer`(`customer_id`, `first_name`, `last_name`, `gender`, `DOB`, `contact`, `email`, `password`) VALUES (NULL, '$fname', '$lname', '$gender','$dob', '$contact','$email','$password' )");
    if ($query) {
        echo "<script>alert('Your account created successfully...!');</script>";
        echo "<script>window.location.href='login.php'</script>";
    } else {
        echo "<script>alert('Account creation failed...!');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign - up</title>
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
    <link rel="stylesheet" href="assets/css/myaccount.css" />


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
                <h2>Sign - up</h2>
                <ul>
                    <li>Home</li>
                    <li class="active">Sign-up</li>
                </ul>
            </div>
        </div>
        <div class="shop">
            <div class="container" style="max-width: 60%; margin: auto;">
                <div class="login-container" style="width: 100%;">
                    <div class="checkout">
                        <div class="container">
                            <form method="post" class="validated-form cta__form__detail" enctype="multipart/form-data">
                                <div class="checkout__form">
                                    <div class="checkout__form__shipping">
                                        <div class="checkout__form__contact__title">
                                            <h4 class="checkout-title">Create your account</h4>
                                        </div>
                                        <div class="row" style="margin-top: 3rem;">
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>First Name <span>*</span>
                                                        <input type="text" name="firstName" required="required" autofocus />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Last Name <span>*</span>
                                                        <input type="text" name="lastName" required="required" />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Gender<span>*</span> </label>
                                                    <select name="gender" style="margin-top: 1rem;">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Date og birth <span>*</span>
                                                        <input type="date" name="dob" required="required" />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-validator">
                                                    <label>Contact <span>*</span>
                                                        <input type="number" name="contact" required="required" />
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
                                                    <label>Password <span>*</span>
                                                        <input type="password" name="password" required="required" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" style="width: 100%;" name="btn_submit" class="btn -red mt-4 mb-4">Create my account</button>
                                        <div class="account__login--divide">
                                            <span class="account__login--divide__text">OR</span>
                                        </div>
                                        <p style="text-align: center; margin-top: 1.5rem; margin-bottom: 2rem">Already Have an Account? <a style="color: #f26460; text-decoration:none; " href="login.php">Log in now</a></p>
                                    </div>
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
</body>

</html>