<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Start session to access login status

// Check if the user is logged in (you can adjust this based on how you store the login status)

//Load Composer's autoloader
require 'vendor/autoload.php';



$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (isset($_POST['btn_appointment'])) {

  $cid = $_SESSION['customer_id'];
  $service_id = $_POST['service'];
  $fname = $_POST['firstName'];
  $lname = $_POST['lastName'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $date = $_POST['date'];
  $messege = $_POST['message'];
  $query = mysqli_query($connection, "INSERT INTO `tbl_appointment` (`appointment_id`, `first_name`, `last_name`, `gender`, `email`, `contact`,`service`, `message`, `appointment_date`, `status`, `customer_id`) VALUES (NULL, '$fname', '$lname', '$gender', '$email', '$contact','$service_id', '$messege ', '$date', 'Pending','$cid')");
  $service_query = mysqli_query($connection,"SELECT * FROM `tbl_service` WHERE service_id=$service_id");
  $service_data = mysqli_fetch_array($service_query);
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
        Service :" . $service_data['service_name'] . "<br/>
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
  <title>Home page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Spartan:wght@300;400;500;700;900&amp;display=swap" />
  <link rel="shortcut icon" type="image/png" href="assets/images/logo1.png" />
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
    <div class="slider -style-1 slider-arrow-middle">
      <div class="slider__carousel">
        <div class="slider__carousel__item slider-1">
          <div class="container">
            <div class="slider-background"><img class="slider-background" src="assets/images/slider/SliderOne/2.png" alt="Slider background" /></div>
            <div class="slider-content">
              <h5 class="slider-content__subtitle" data-animation-in="fadeInUp" data-animation-delay="0.2">When you look
                good</h5>
              <h1 class="slider-content__title" data-animation-in="fadeInUp" data-animation-delay="0.3">You feel good
              </h1>
              <div data-animation-in="fadeInUp" data-animation-out="fadeInDown" data-animation-delay="0.6"><button id="appointment-btn" class="btn -red appointment-btn">Appointment</button>
              </div>
            </div>
          </div>
        </div>
        <div class="slider__carousel__item slider-2">
          <div class="container">
            <div class="slider-background"><img class="slider-background" src="assets/images/slider/SliderOne/1.png" alt="Slider background" /></div>
            <div class="slider-content">
              <h5 class="slider-content__subtitle" data-animation-in="fadeInUp" data-animation-delay="0.2">bringing you
              </h5>
              <h1 class="slider-content__title" data-animation-in="fadeInUp" data-animation-delay="0.3">Inner beauty out
              </h1>
              <div data-animation-in="fadeInUp" data-animation-out="fadeInDown" data-animation-delay="0.6"><button id="appointment-btn" class="btn -red appointment-btn">Appointment</button>
              </div>
            </div>
          </div>
        </div>
        <div class="slider__carousel__item slider-3">
          <div class="container">
            <div class="slider-background"><img class="slider-background" src="assets/images/slider/SliderOne/3.png" alt="Slider background" /></div>
            <div class="slider-content">
              <h5 class="slider-content__subtitle" data-animation-in="fadeInUp" data-animation-delay="0.2">We make best
                makeup</h5>
              <h1 class="slider-content__title" data-animation-in="fadeInUp" data-animation-delay="0.3">Beauty salon
              </h1>
              <div data-animation-in="fadeInUp" data-animation-out="fadeInDown" data-animation-delay="0.6"><button id="appointment-btn" class="btn -red appointment-btn">Appointment</button>
              </div>
            </div>
          </div>
        </div>
        <div class="slider__carousel__item slider-4">
          <div class="container">
            <div class="slider-background"><img class="slider-background" src="assets/images/slider/SliderTwo/3.png" alt="Slider background" /></div>
            <div class="slider-content">
              <h5 class="slider-content__subtitle" data-animation-in="fadeInUp" data-animation-delay="0.1">Fragrances
                that make moments</h5>
              <h1 class="slider-content__title" data-animation-in="fadeInUp" data-animation-delay="0.2">Unforgettable
              </h1>
              <div data-animation-in="fadeInUp" data-animation-out="fadeInDown" data-animation-delay="0.4"><a class="btn -red" href="shop.php">Shop now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="introduction-three">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-6">
            <div class="introduction-three__image">
              <div class="introduction-three__image__background"><img src="assets/images/introduction/IntroductionThree/bg.png" alt="background" /></div>
              <div class="introduction-three__image__detail">
                <div class="image__item">
                  <div class="wrapper"><img data-depth="0.3" src="assets/images/introduction/IntroductionThree/img-1.png" alt="image" /></div>
                </div>
                <div class="image__item">
                  <div class="wrapper"><img data-depth="0.8" src="assets/images/introduction/IntroductionThree/img-2.png" alt="image" /></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="introduction-three__content">
              <h5>About Glam</h5>
              <h3><span>Natural</span>skin care<br />professional</h3>
              <div class="more-description"><img src="assets/images/introduction/IntroductionThree/decoration.png" alt="Decoration" /><span>Best treatment for curing stubborn whiteheads. Your skin loves it</span>
              </div>
              <p>Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                aliqua. Quis pendisse ultrices gravida. Risus commodo viverra lacus vel facilisis.</p><button class="btn -white appointment-btn">Appointment</button>
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
    <div class="introduction-four">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-4">
                <div class="introduction-four__item -style-1">
                  <div class="introduction-four__item__content">
                    <h3>Meet<span>trends</span></h3>
                    <h5>of the season</h5><a class="btn btn -transparent -underline" href="shop.php">Shop Now</a>
                  </div>
                  <div class="introduction-four__item__image"><img src="assets/images/introduction/IntroductionFour/1.png" alt="Meet trends of the season" /></div>
                </div>
              </div>
              <div class="col-12 col-md-6 mx-auto">
                <div class="introduction-four__item -style-2">
                  <div class="introduction-four__item__content">
                    <h3>Skin<span>2.0</span></h3>
                    <h5>Your regimen upgraded</h5><a class="btn btn -transparent -underline" href="shop.php">Shop Now</a>
                  </div>
                  <div class="introduction-four__item__image"><img src="assets/images/introduction/IntroductionFour/2.png" alt="Meet trends of the season" /></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-5">
                <div class="introduction-four__item -style-1">
                  <div class="introduction-four__item__content">
                    <h3><span>Alima</span></h3>
                    <h5>Matte Collection</h5><a class="btn btn -transparent -underline" href="shop.php">Shop Now</a>
                  </div>
                  <div class="introduction-four__item__image"><img src="assets/images/introduction/IntroductionFour/3.png" alt="Meet trends of the season" /></div>
                </div>
              </div>
              <div class="col-12 col-md-6 ml-auto">
                <div class="introduction-four__item -style-2">
                  <div class="introduction-four__item__content">
                    <h3>Up to<span>70%</span>off</h3>
                    <h5>Limited time only</h5><a class="btn btn -transparent -underline" href="shop.php">Shop Now</a>
                  </div>
                  <div class="introduction-four__item__image"><img src="assets/images/introduction/IntroductionFour/4.png" alt="Meet trends of the season" /></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="dow-one">
      <div class="dow-one__image"><img src="assets/images/deal_of_week/DOWOne/1.png" alt="Dale of the week image" />
      </div>
      <div class="dow-one__content">
        <h5>DEAL OF THE WEEK</h5>
        <h3>Lip and liner duo</h3>
        <div class="dow-one__content__countdown" id="clock"></div><a class="btn -dark" href="shop.php">Shop now</a>
      </div>
    </div>
    <div class="testimonial">
      <div class="section-title -center" style="margin-bottom: 3.125rem">
        <h5>TESTIMONIAL</h5>
        <h2>What People Say?</h2><img src="assets/images/introduction/IntroductionOne/content-deco.png" alt="Decoration" />
      </div>
      <div class="container">
        <div class="testimonial-slider">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="slide-nav">
                <div class="slide-nav__wrapper">
                  <div class="slide-nav__item" key="0"><img src="assets/images/testimonial/TestimonialOne/1.png" alt="Customer avatar" /></div>
                  <div class="slide-nav__item" key="1"><img src="assets/images/testimonial/TestimonialOne/2.png" alt="Customer avatar" /></div>
                  <div class="slide-nav__item" key="2"><img src="assets/images/testimonial/TestimonialOne/3.png" alt="Customer avatar" /></div>
                  <div class="slide-nav__item" key="3"><img src="assets/images/testimonial/TestimonialOne/4.png" alt="Customer avatar" /></div>
                  <div class="slide-nav__item" key="4"><img src="assets/images/testimonial/TestimonialOne/5.png" alt="Customer avatar" /></div>
                  <div class="slide-nav__item" key="5"><img src="assets/images/testimonial/TestimonialOne/6.png" alt="Customer avatar" /></div>
                  <div class="slide-nav__item" key="6"><img src="assets/images/testimonial/TestimonialOne/7.png" alt="Customer avatar" /></div>
                  <div class="slide-nav__item" key="7"><img src="assets/images/testimonial/TestimonialOne/8.png" alt="Customer avatar" /></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="slide-for">
                <div class="slide-for__wrapper">
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Alexander Ball</h3>
                        <h5>New York</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Izabel Watt</h3>
                        <h5>Michigan</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Rachel Regan</h3>
                        <h5>Sydney</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Malika Kenny</h3>
                        <h5>Ha Noi</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Javier Bender</h3>
                        <h5>Tokyo</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Paul Brookes</h3>
                        <h5>Berlin</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Bilaal Gunn</h3>
                        <h5>Denver</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                  <div class="slide-for__item">
                    <div class="slide-for__item__header">
                      <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                      <div class="customer__info">
                        <h3>Musab O'Sullivan</h3>
                        <h5>Paris</h5>
                      </div>
                      <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                    <p class="slide-for__item__content">I love my lash tint! I don't have extremely blonde lashes, but I
                      do like that they can be even darker than they are. It makes my eyes stand out more and I love the
                      way it looks! Now, I just need to add on a bit of mascara for length and I am set.</p>
                  </div>
                </div>
                <div class="testimonial-one__slider-control"><a class="prev" href="#"><i class="far fa-angle-left">
                    </i>Prev</a><a class="next" href="#">Next<i class="far fa-angle-right"> </i></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="team-one">
      <div class="container">
        <div class="section-title -center" style="margin-bottom: 1.875em">
          <h2>Professional team</h2><img src="assets/images/introduction/IntroductionOne/content-deco.png" alt="Decoration" />
        </div>
        <div class="team-one-slider">
          <div class="slider__item">
            <div class="team-card">
              <div class="team-card__avatar"><img src="assets/images/team/teamOne/1.png" alt="Danielle Welling" /></div>
              <div class="team-card__content">
                <h3>Danielle Welling</h3>
                <h5>Nail master</h5>
                <p>Ipsum dolor amet, consectetur adipiscing sedo lacus facilisis.</p>
                <socialicons></socialicons>
              </div>
            </div>
          </div>
          <div class="slider__item">
            <div class="team-card">
              <div class="team-card__avatar"><img src="assets/images/team/teamOne/2.png" alt="Cali Lees" /></div>
              <div class="team-card__content">
                <h3>Cali Lees</h3>
                <h5>Administrator</h5>
                <p>Ipsum dolor amet, consectetur adipiscing sedo lacus facilisis.</p>
                <socialicons></socialicons>
              </div>
            </div>
          </div>
          <div class="slider__item">
            <div class="team-card">
              <div class="team-card__avatar"><img src="assets/images/team/teamOne/3.png" alt="Danielle Welling" /></div>
              <div class="team-card__content">
                <h3>Danielle Welling</h3>
                <h5>Hair stylish</h5>
                <p>Ipsum dolor amet, consectetur adipiscing sedo lacus facilisis.</p>
                <socialicons></socialicons>
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
                    <input type="text" placeholder="First Name" name="firstName" required="required" />
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="input-validator">
                    <input type="text" placeholder="Last Name" name="lastName" required="required" />
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="input-validator">
                    <input type="text" placeholder="Email" name="email" required="required" />
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="input-validator">
                    <input type="text" placeholder="Contact" name="contact" required="required" />
                  </div>
                </div>
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
                      $service_query = mysqli_query($connection, "select * from tbl_service");

                      while ($fetch_service = mysqli_fetch_array($service_query)) {
                        echo "<option value='" . $fetch_service['service_id'] . "'>" . $fetch_service['service_name'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-12">
                  <div class="input-validator">
                    <input type="datetime-local" id="datetime" name="date" min="" max="" step="600" required="required" />
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-validator">
                    <textarea type="text" placeholder="Note about your appointment (optional)" name="message"></textarea>
                  </div>
                </div>
              </div>
              <button class="btn -red" name="btn_appointment">Book appointment now
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
  <script>
    const buttons = document.querySelectorAll('.appointment-btn');
    const form = document.getElementById('appointment-form');

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        form.scrollIntoView({
          behavior: "smooth"
        });
      });
    });
  </script>


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