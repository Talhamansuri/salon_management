<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (isset($_POST['btn_submit'])) {

    $payment_type = $_POST['paymentoption'];
    $customer_id = $_SESSION['customer_id'];
    $order_id = $_SESSION['order_id'];
    $total_amount = $_SESSION["total"];
    $name = $_SESSION['order_name'];
    $current_date = date("Y-m-d H:i:s");

    echo $payment_type;


    $payment_query = mysqli_query($connection, "INSERT INTO `tbl_payment`(`amount`, `payment_type`, `order_id`, `customer_id`) VALUES ('$total_amount','$payment_type','$order_id','$customer_id')");

    if ($payment_type == "COD") {
        $order_query = mysqli_query($connection, "UPDATE `tbl_order` SET `payment_status`='Pending' WHERE order_id=$order_id");
    } else {
        $order_query = mysqli_query($connection, "UPDATE `tbl_order` SET `payment_status`='Completed' WHERE order_id=$order_id");
    }

    if ($payment_query) {

        //send email
        $mail = new PHPMailer(true);
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'glamsalon001@gmail.com';
        $mail->Password   = 'lhwk cnwu wcrc hocc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('glamsalon001@gmail.com', 'Glam Salon');
        $mail->addAddress('furkanshaikh2138@gmail.com', $name);     //Add a recipient

        //Content
        $mail->isHTML(true);
        //Set email format to HTML
        $mail->Subject = "Order Confirmation";
        $mail->Body    = "<h4>Dear " . $name . ",</h4><br/>
        Thank you for shopping with us! we`re excited to have you as our valued customer, Here are the details of your order,<br/>
        <br/>
        Order:#" . $order_id . "<br/>
        placed on :" . $current_date . "<br/>
        <b>Total amount :" . $total_amount . "<br/></b></b>
        Please not that your order will be processed and shipped within 7-days.
        You will recieve a saperate  email with the tracking information once your order has been dispatched.
        <br/>
        Should you have any further inquiries, don't hesitate to contact us.<br/><br/>
        Best regards,<br/>Glam salon Team";
        $mail->send();

        echo "<script>alert('Order Placed successfully ...!');</script>";
        unset($_SESSION['cart']);
        unset($_SESSION['counter']);
        unset($_SESSION['qty']);
        unset($_SESSION['order_id']);
        unset($_SESSION['order_name']);

        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Order failed...!');</script>";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Payment</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


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
                <h2>Payment</h2>
                <ul>
                    <li>Home</li>
                    <li class="active">Payment</li>
                </ul>
            </div>
        </div>
        <div class="shop">
            <div class="container" style="max-width: 50%; margin: auto;">
                <div class="checkout">
                    <div class="container">
                        <div class="login-container" style="width: 750px;">
                            <form method="post" id="myform" class="aa-login-form">
                                <div class="aa-myaccount-area">
                                    <div class="checkout__form__contact__title">
                                        <h5 class="checkout-title">Complate your payment</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="aa-myaccount-login">
                                                <br />
                                                <input type="radio" id="pcash" value="COD" name="paymentoption" />
                                                <b>Cash on delivery</b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="pupi" value="UPI" name="paymentoption" /> <b>UPI</b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="pcard" value="Card" name="paymentoption" /> <b>CreditCard/Debitcard</b>
                                                <div class="icon-container" style="margin-left: 190px;">
                                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                                </div>
                                                <div id="upiimg">
                                                    <img src="https://storage.googleapis.com/dara-c1b52.appspot.com/daras_ai/media/a3202e58-17ef-11ee-9a70-8e93953183bb/cleaned_qr.png" style="width:100px;height:100px;">

                                                    <p><b>Either Scan Image or Enter UPI No</b></p>
                                                </div>
                                                <div class="form-group" id="upitxt">
                                                    <input type="radio" name="upi_method" value="GPay" onchange="return enter_upi_id()">
                                                    <img src="https://t3.ftcdn.net/jpg/06/16/18/18/360_F_616181843_l404nbV07vMiXDZ1IhWiqZRDpetpuigu.jpg" style="width: 150px;">
                                                    <br>
                                                    <input class="form-control uip_id" type="varchar" name="txt1" placeholder="UPI ID">
                                                </div>

                                                <div class="form-group" id="txt1">

                                                    <label for="">Name<span>*</span></label>
                                                    <input class="form-control" type="varchar" name="txt1" placeholder="Name">
                                                </div>
                                                <div class="form-group" id="txt2">
                                                    <label for="">Card No<span>*</span></label>
                                                    <input class="form-control" type="number" name="txt2" placeholder="4134 - 1024 - 3640">
                                                </div>
                                                <div class="form-group" id="txt3">
                                                    <label for="">CVV<span>*</span></label>
                                                    <input class="form-control" type="number" name="txt3" placeholder="Card No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" style="width:100%;" name="btn_submit" class="btn -red mb-4">Place order</button>
                                <a href="index.php" style="width:100%;" class="btn -white mb-4">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php
        include "footer.php";
        ?>
        <!-- / footer -->
        <div class="drawer drawer-right slide" id="mobile-menu-drawer" tabindex="-1" role="dialog" aria-labelledby="drawer-demo-title" aria-hidden="true">
            <div class="drawer-content drawer-content-scrollable" role="document">
                <div class="drawer-body">
                    <div class="cart-sidebar">
                        <div class="cart-items__wrapper">
                            <div class="navigation-sidebar">
                                <div class="search-box">
                                    <form>
                                        <input type="text" placeholder="What are you looking for?" />
                                        <button><img src="assets/images/header/search-icon.png" alt="Search icon" /></button>
                                    </form>
                                </div>
                                <div class="navigator-mobile">
                                    <ul>
                                        <li class="relative"><a class="dropdown-menu-controller" href="#">Home<span class="dropable-icon"><i class="fas fa-angle-down"></i></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="homepages/homepage1.html/index.html">Beauty Salon</a></li>
                                                <li><a href="homepages/homepage2.html/index.html">Makeup Salon</a></li>
                                                <li><a href="homepages/homepage3.html/index.html">Natural Shop</a></li>
                                                <li><a href="homepages/homepage4.html/index.html">Spa Shop</a></li>
                                                <li><a href="homepages/homepage5.html/index.html">Mask Shop</a></li>
                                                <li><a href="homepages/homepage6.html/index.html">Skincare Shop</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="services.html">Services</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a class="dropdown-menu-controller" href="#">Shop<span class="dropable-icon"><i class="fas fa-angle-down"></i></span></a>
                                            <ul class="dropdown-menu">
                                                <ul class="dropdown-menu__col">
                                                    <li><a href="shop-fullwidth-4col.html">Shop Fullwidth 4 Columns</a></li>
                                                    <li><a href="shop-fullwidth-5col.html">Shop Fullwidth 5 Columns</a></li>
                                                    <li><a href="shop-fullwidth-left-sidebar.html">Shop Fullwidth Left Sidebar</a></li>
                                                    <li><a href="shop-fullwidth-right-sidebar.html">Shop Fullwidth Right Sidebar</a></li>
                                                </ul>
                                                <ul class="dropdown-menu__col">
                                                    <li><a href="shop-grid-4col.html">Shop grid 4 Columns</a></li>
                                                    <li><a href="shop-grid-3col.html">Shop Grid 3 Columns</a></li>
                                                    <li><a href="shop-grid-sidebar.html">Shop Grid Sideber</a></li>
                                                    <li><a href="shop-list-sidebar.html">Shop List Sidebar</a></li>
                                                </ul>
                                                <ul class="dropdown-menu__col">
                                                    <li><a href="#">Product Detail</a></li>
                                                    <li><a href="cart.html">Shopping cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="wishlist.html">Wish list</a></li>
                                                </ul>
                                                <ul class="dropdown-menu__col -banner"><a href="shop-fullwidth-4col.html"><img src="assets/images/header/dropdown-menu-banner.png" alt="New product banner.html" /></a>
                                                </ul>
                                            </ul>
                                        </li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </div>
                                <div class="navigation-sidebar__footer">
                                    <select class="customed-select -borderless" name="currency">
                                        <option value="usd">USD</option>
                                        <option value="vnd">VND</option>
                                        <option value="yen">YEN</option>
                                    </select>
                                    <select class="customed-select -borderless" name="currency">
                                        <option value="en">EN</option>
                                        <option value="vi">VI</option>
                                        <option value="jp">JP</option>
                                    </select>
                                </div>
                                <div class="social-icons ">
                                    <ul>
                                        <li><a href="https://www.facebook.com/" style="color: undefined"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/" style="color: undefined"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://instagram.com/" style="color: undefined"><i class="fab fa-instagram"> </i></a>
                                        </li>
                                        <li><a href="https://www.youtube.com/" style="color: undefined"><i class="fab fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- payment-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function() {
            $("input[name='paymentoption']").click(function() {
                if ($("#pcard").is(":checked")) {
                    $("#txt1").show();
                    $("#txt2").show();
                    $("#txt3").show();
                    $("#upitxt").hide();
                    $("#upiimg").hide();
                } else if ($("#pupi").is(":checked")) {

                    $("#txt1").hide();
                    $("#txt2").hide();
                    $("#txt3").hide();
                    $("#upitxt").show();
                    $("#upiimg").show();
                } else {
                    $("#txt1").hide();
                    $("#txt2").hide();
                    $("#txt3").hide();
                    $("#upitxt").hide();
                    $("#upiimg").hide();
                }
            });
        });

        $(document).ready(function() {
            $("#txt1").hide();
            $("#txt2").hide();
            $("#txt3").hide();
            $("#upitxt").hide();
            $("#upiimg").hide();
        });

        $(".uip_id").hide();

        function enter_upi_id() {
            $(".uip_id").show();
        }
    </script>

    <script>
        $("#pay_now").click();
    </script>
</body>

</html>