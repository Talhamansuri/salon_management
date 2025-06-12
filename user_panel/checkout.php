<?php

session_start();

if (!isset($_SESSION['customer_id'])) {
  echo "<script>alert('First you need to login')</script>";
  echo "<script>window.location.href='login.php'</script>";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (isset($_POST["btn_checkout"])) {
  $customer_id = $_SESSION['customer_id'];
  $fname = $_POST['firstName'];
  $lname = $_POST['lastName'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $address = $_POST['lane1'] . $_POST['lane2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $pin_code = $_POST['pin_code'];
  $order_notes = $_POST['note'];
  $current_date = date("Y-m-d H:i:s");
  $total_amount = $_SESSION["total"];

  $order_query = mysqli_query($connection, "INSERT INTO `tbl_order`(`order_id`, `first_name`, `last_name`, `email`, `contact`, `order_add`, `city`, `state`, `country`, `pin_code`, `order_notes`, `order_date`, `order_amt`, `order_status`, `customer_id`) VALUES ('','$fname','$lname','$email','$contact','$address','$city','$state','$country','$pin_code','$order_notes','$current_date','$total_amount','Pending','$customer_id')") or die(mysqli_errno($connection));
  $order_id = mysqli_insert_id($connection);
  $_SESSION['order_id'] = $order_id;
  $_SESSION['order_name'] = "$fname $lname";


  foreach ($_SESSION['cart'] as $key => $value) {

    $data_query = mysqli_query($connection, "SELECT * FROM tbl_product WHERE product_id='$value'");
    $data = mysqli_fetch_array($data_query);
    $product_price = $data['product_price'];
    $qty = $_SESSION['qty'][$key];
    $order_details_query = "INSERT INTO tbl_order_details(order_id, quantity, price, product_id) VALUES ('$order_id', '$qty', '$product_price', '$value')";

    // Execute the query for order details
    $order_details_result = mysqli_query($connection, $order_details_query);

    if (!$order_details_result) {
      echo "<script>alert('Error occurred while inserting order details.');</script>";
      exit;
    }
  }

  header("location:payment_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Checkout</title>
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
        <h2>Checkout</h2>
        <ul>
          <li>Home</li>
          <li>Shop</li>
          <li class="active">Checkout</li>
        </ul>
      </div>
    </div>
    <div class="shop">
      <div class="container">
        <div class="checkout">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8">
                <form method="post" class="validated-form cta__form__detail">
                  <div class="checkout__form">
                    <div class="checkout__form__contact">
                      <div class="checkout__form__contact__title">
                        <h5 class="checkout-title">Contact information</h5>
                      </div>
                      <div class="input-validator">
                        <input type="text" name="email" placeholder="Email" />
                      </div>
                      <div class="input-validator">
                        <input type="number" name="contact" placeholder="Phone number" />
                      </div>
                    </div>
                    <div class="checkout__form__shipping">
                      <h5 class="checkout-title">Shipping address</h5>
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
                            <label>Address <span>*</span>
                              <input type="text" name="lane1" placeholder="Steet address" required="required" />
                              <input type="text" name="lane2" placeholder="Apartment, suite, unite etc. ( optional )" />
                            </label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-validator">
                            <label>Town/City <span>*</span>
                              <input type="text" name="city" required="required" />
                            </label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-validator">
                            <label>State <span>*</span>
                              <input type="text" name="state" required="required" />
                            </label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-validator">
                            <label>Country <span>*</span>
                              <input type="text" name="country" required="required" />
                            </label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-validator">
                            <label>Postcode/ZIP <span>*</span>
                              <input type="text" name="pin_code" required="required" />
                            </label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-validator">
                            <label>Order note
                              <input type="text" name="note" placeholder="Note about your order, e.g, special noe for delivery" />
                            </label>
                          </div>
                        </div>
                      </div>
                      <button type="submit" style="width:100%;" name="btn_checkout" class="btn -red">checkout</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-12 col-lg-4">
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-12 ml-auto">
                    <div class="checkout__total">
                      <div class="checkout__total__price">
                        <h5>Product</h5>
                        <table>
                          <colgroup>
                            <col style="width: 70%" />
                            <col style="width: 30%" />
                          </colgroup>
                          <tbody>
                            <?php
                            $total = 0;
                            foreach ($_SESSION['cart'] as $key => $value) {
                              $cart_query = mysqli_query($connection, "select * from tbl_product where product_id=$value");
                              $cart_data = mysqli_fetch_array($cart_query);
                              $qty = $_SESSION['qty'][$key];
                              $subtotal = $cart_data['product_price'] * $qty;
                              $total += $subtotal;

                              echo "<tr>
                              <td><span>" . $qty . " x </span>" . $cart_data['product_name'] . "
                              </td>
                              <td>&#8377 " . $cart_data['product_price'] . "</td>
                            </tr>";
                            }
                            ?>

                          </tbody>
                        </table>
                        <div class="checkout__total__price__total-count">
                          <table>
                            <tbody>
                              <tr>
                                <td>Subtotal</td>
                                <td>&#8377;<?php $sub_total = $_SESSION['total'];
                                            echo $total; ?></td>
                              </tr>
                              <tr>
                                <td>Total</td>
                                <td>&#8377;<?php echo $sub_total; ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
</body>

</html>