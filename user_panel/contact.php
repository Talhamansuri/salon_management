<?php
require "connection.php";



if (isset($_POST['btn_send'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $messege = $_POST['message'];
  $date = date("Y-m-d H:i:s");

  $query = mysqli_query($connection, "INSERT INTO `tbl_contact`(`customer_name`, `email`, `contact`, `message`, `contact_date`) VALUES ('$name','$email','$contact','$messege','$date')");

  if ($query) {

    echo "<script>alert('Message Sent successfully ...!');</script>";

  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Contact</title>
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
        <h2>Contact</h2>
        <ul>
          <li>Home</li>
          <li class="active">Contact us</li>
        </ul>
      </div>
    </div>
    <div class="contact">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6">
            <h3 class="contact-title">Contact info</h3>
            <div class="contact-info__item">
              <div class="contact-info__item__icon"><i class="fas fa-map-marker-alt"></i></div>
              <div class="contact-info__item__detail">
                <h3>Address</h3>
                <p>15, JL Complex, Balvatika, Maninagar,<br /> Ahmedabad, Gujarat-380008</p>
              </div>
            </div>
            <div class="contact-info__item">
              <div class="contact-info__item__icon"><i class="fas fa-phone-alt"></i></div>
              <div class="contact-info__item__detail">
                <h3>Phone</h3>
                <p>+91 8401238842 | +91 9725063177</p>
              </div>
            </div>
            <div class="contact-info__item">
              <div class="contact-info__item__icon"><i class="far fa-envelope"></i></div>
              <div class="contact-info__item__detail">
                <h3>Email</h3>
                <p>glamsalon001@gmail.com</p>
              </div>
            </div>
            <div class="contact-info__item">
              <div class="contact-info__item__icon"><i class="far fa-clock"></i></div>
              <div class="contact-info__item__detail">
                <h3>Opentime</h3>
                <p>Sun-Sat: 9.00am - 10.00pm</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <h3 class="contact-title">Get in touch</h3>
            <div class="contact-form">
              <form method="post">
                <div class="input-validator">
                  <input type="text" name="name" placeholder="Name" />
                </div>
                <div class="input-validator">
                  <input type="text" name="email" placeholder="Email" />
                </div>
                <div class="input-validator">
                  <input type="number" name="contact" placeholder="contact" />
                </div>
                <div class="input-validator">
                  <textarea name="message" id="" cols="30" rows="3" placeholder="Message"></textarea>
                </div>
                <button type="submit" name="btn_send" class="btn -dark">SEND MESSAGE</button>
              </form>
            </div>
          </div>
          <div class="col-12">
            <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d229.54841331291192!2d72.60406069457531!3d22.995314115989412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e85e7c3f9b791%3A0xd310564642f576f9!2sClam%20Salon%20Hair%20And%20Beauty%20Care!5e0!3m2!1sen!2sin!4v1708780103957!5m2!1sen!2sin" width="100%" height="450" style="border:0;" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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