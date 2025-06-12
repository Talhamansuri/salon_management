<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (isset($_POST['btn_appointment'])) {

  $customer_id = $_SESSION['customer_id'];
  $customer_name = $_SESSION['customer_name'];

  $service_id = $_POST['service'];
  $gender = $_POST['gender'];
  $date = $_POST['date'];
  $messege = $_POST['message'];
  $query = mysqli_query($connection, "INSERT INTO `tbl_appointment` (`appointment_id`, `gender`,`service`, `message`, `appointment_date`, `status`) VALUES (NULL,'$gender','$service_id', '$messege ', '$date', 'Pending')");
  if ($query) {
    echo "<script>alert('Appointment booked successfully...!');</script>";
  } else {
    echo "<script>alert('Booking Failed failed...!');</script>";
  }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Services</title>
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
        <h2>Services</h2>
        <ul>
          <li>Home</li>
          <li class="active">Services</li>
        </ul>
      </div>
    </div>
    <div class="shop">
      <div class="container">
        <div class="services__item">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="services__item__image">
                <div class="services__item__image__background"><img src="assets/images/introduction/IntroductionThree/bg.png" alt="background" /></div>
                <div class="services__item__image__detail">
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.3" src="assets/images/contact/1_1.png" alt="image" /></div>
                  </div>
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.2" data-invert-x="true" data-invert-y="true" src="assets/images/contact/1.png" /></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="services__item__content">
                <div class="services__item__order">
                  <h3>01.</h3>
                </div>
                <h2 class="services__item__title">Body treatment</h2>
                <p class="services__item__description">Dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Quis pendisse ultrices gravida. Risus commodo
                  viverra lacus vel facilisis.</p>
                <ul>
                  <li><i class="fas fa-check"></i>Lorem ipsum dolor sit amet, consectetur.</li>
                  <li><i class="fas fa-check"></i>Adipiscing elit, sed do eiusmod tempor.</li>
                  <li><i class="fas fa-check"></i>Incididunt ut labore et dolore magna aliqua.</li>
                  <li><i class="fas fa-check"></i>Quis ipsum suspendisse ultrices gravida.</li>
                </ul><a class="btn -white" href="#">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="services__item -reverse">
          <div class="row">
            <div class="col-12 col-md-6 order-md-2">
              <div class="services__item__image">
                <div class="services__item__image__background"><img src="assets/images/introduction/IntroductionThree/bg.png" alt="background" /></div>
                <div class="services__item__image__detail">
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.3" src="assets/images/contact/2_1.png" alt="image" /></div>
                  </div>
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.2" data-invert-x="true" data-invert-y="true" src="assets/images/contact/2.png" /></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 order-md-1">
              <div class="services__item__content">
                <div class="services__item__order">
                  <h3>02.</h3>
                </div>
                <h2 class="services__item__title">Professinal makeup</h2>
                <p class="services__item__description">Dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Quis pendisse ultrices gravida. Risus commodo
                  viverra lacus vel facilisis.</p>
                <ul>
                  <li><i class="fas fa-check"></i>Lorem ipsum dolor sit amet, consectetur.</li>
                  <li><i class="fas fa-check"></i>Adipiscing elit, sed do eiusmod tempor.</li>
                  <li><i class="fas fa-check"></i>Incididunt ut labore et dolore magna aliqua.</li>
                  <li><i class="fas fa-check"></i>Quis ipsum suspendisse ultrices gravida.</li>
                </ul><a class="btn -white" href="#">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="services__item">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="services__item__image">
                <div class="services__item__image__background"><img src="assets/images/introduction/IntroductionThree/bg.png" alt="background" /></div>
                <div class="services__item__image__detail">
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.3" src="assets/images/contact/3_1.png" alt="image" /></div>
                  </div>
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.2" data-invert-x="true" data-invert-y="true" src="assets/images/contact/3.png" /></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="services__item__content">
                <div class="services__item__order">
                  <h3>03.</h3>
                </div>
                <h2 class="services__item__title">Maincure &amp; pedicure</h2>
                <p class="services__item__description">Dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Quis pendisse ultrices gravida. Risus commodo
                  viverra lacus vel facilisis.</p>
                <ul>
                  <li><i class="fas fa-check"></i>Lorem ipsum dolor sit amet, consectetur.</li>
                  <li><i class="fas fa-check"></i>Adipiscing elit, sed do eiusmod tempor.</li>
                  <li><i class="fas fa-check"></i>Incididunt ut labore et dolore magna aliqua.</li>
                  <li><i class="fas fa-check"></i>Quis ipsum suspendisse ultrices gravida.</li>
                </ul><a class="btn -white" href="#">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="services__item -reverse">
          <div class="row">
            <div class="col-12 col-md-6 order-md-2">
              <div class="services__item__image">
                <div class="services__item__image__background"><img src="assets/images/introduction/IntroductionThree/bg.png" alt="background" /></div>
                <div class="services__item__image__detail">
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.3" src="assets/images/contact/4_1.png" alt="image" /></div>
                  </div>
                  <div class="image__item">
                    <div class="wrapper"><img data-depth="0.2" data-invert-x="true" data-invert-y="true" src="assets/images/contact/4.png" /></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 order-md-1">
              <div class="services__item__content">
                <div class="services__item__order">
                  <h3>04.</h3>
                </div>
                <h2 class="services__item__title">Hair cut &amp; Coloring</h2>
                <p class="services__item__description">Dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Quis pendisse ultrices gravida. Risus commodo
                  viverra lacus vel facilisis.</p>
                <ul>
                  <li><i class="fas fa-check"></i>Lorem ipsum dolor sit amet, consectetur.</li>
                  <li><i class="fas fa-check"></i>Adipiscing elit, sed do eiusmod tempor.</li>
                  <li><i class="fas fa-check"></i>Incididunt ut labore et dolore magna aliqua.</li>
                  <li><i class="fas fa-check"></i>Quis ipsum suspendisse ultrices gravida.</li>
                </ul><a class="btn -white" href="#">Read more</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cta -style-2" style="background-image: url(_assets/images/cta/CTATwo/1.png/index.html)">
      <div class="container" id="appointment-form">
        <div class="row">
          <div class="col-12">
            <div class="cta__form">
              <h3>Don’t Wait Any Longer! <br /> Book Your Appointment Now!</h3>
            </div>
            <form method="post" class="validated-form cta__form__detail">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="input-validator">
                    <select class="customed-select required" name="gender">
                      <option value="" hidden="hidden">Select Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="input-validator">
                    <select class="customed-select required" name="service">
                      <option value="" hidden="hidden">Choose a services</option>
                      <?php
                      $service_query = mysqli_query($connection, "select * from tbl_service_category");

                      while ($fetch_service = mysqli_fetch_array($service_query)) {
                        echo "<option value='" . $fetch_service['category_id'] . "'>" . $fetch_service['category_name'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-validator">
                    <input type="datetime-local" placeholder="" name="date" required="required" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-validator">
                    <textarea type="text" placeholder="Note about your appointment (optional)" name="message"></textarea>
                  </div>
                </div>
              </div>
              <button class="btn -dark" name="btn_appointment">Book appointment now
              </button>
            </form>
          </div>
        </div>
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