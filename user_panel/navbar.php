<div class="header -one">
  <div class="menu -style-1">
    <div class="container">
      <div class="menu__wrapper"><a class="menu-logo" href="index.php"><img style="height: 100px; width: 120px;" src="assets/images/logo2.png" alt="Logo" /></a>
        <div class="navigator ">
          <ul>
            <li class="relative"><a href="index.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="">Category<span class="dropable-icon"><i class="fas fa-angle-down"></i></span></a>
              <ul class="dropdown-menu -wide">
                <ul class="dropdown-menu__col">

                
                  <li><a href="shop.php?cat_id=1">Hair care</a></li>
                  <li><a href="shop.php?cat_id=2">Skin care</a></li>
                  <li><a href="shop.php?cat_id=5">Body Care</a></li>
                  <li><a href="shop.php?cat_id=4">Nail care</a></li>

                </ul>
                <ul class="dropdown-menu__col">
                  <li><a href="shop.php?cat_id=8">Makeup</a></li>
                  <li><a href="shop.php?cat_id=7">Eye Care</a></li>
                  <li><a href="shop.php?cat_id=9">Lip Care</a></li>
                  <li><a href="shop.php?cat_id=12">Hand care</a></li>
                </ul>
                <ul class="dropdown-menu__col">
                  <li><a href="shop.php?cat_id=11">Men's care</a></li>
                  <li><a href="shop.php?cat_id=3">Hair tools</a></li>
                  <li><a href="shop.php?cat_id=6">Makeup Tools</a></li>
                </ul>
                <ul class="dropdown-menu__col -banner"><a href="shop-fullwidth-4col.html"><img src="assets/images/header/dropdown-menu-banner.png" alt="New product banner" /></a></ul>
              </ul>
            </li>
            <li><a href="contact.php">Contact</a></li>
            <li class="relative"><a>Reservation<span class="dropable-icon"><i class="fas fa-angle-down"></i></span></a>
              <ul class="dropdown-menu">
                <li style="font-size: 15px;"><a href="appointment.php">Book Appointment</a></li>
                <li style="font-size: 15px;"><a href="my_account.php">View Appointment</a></li>
                <li style="font-size: 15px;"><a href="my_account.php">Check history</a></li>
              </ul>
            </li>
            <?php
            if (!isset($_SESSION['customer_id'])) {
              echo "<li><a href='login.php'>Log In</a></li>";
            } else {
              echo "<li><a href='logout.php'>Log out</a></li>";
            }
            ?>
          </ul>
        </div>
        <div class="menu-functions "><a class="menu-icon -search" href="#"><img src="assets/images/header/search-icon.png" alt="Search icon" /></a>
          <div class="search-box">
            <form>
              <input type="text" placeholder="What are you looking for?" name="search" />
              <button><img src="assets/images/header/search-icon.png" alt="Search icon" /></button>
            </form>
          </div>
          <a class="menu-icon -wishlist" href="wishlist.php"><img src="assets/images/header/wishlist-icon.png" alt="Account icon" /></a>
          <a class="menu-icon -wishlist" href="my_account.php"><img src="assets/images/header/user2.png" alt="Account icon" /></a>
          <div class="menu-cart"><a class="menu-icon -cart" href="#"><img src="assets/images/header/cart-icon.png" alt="cart icon" /><span class="cart__quantity" style="color: red; font-weight:bold;"><?php if (isset($_SESSION['cart'])) {
                                                                                                                                                                                                          $cart_item = count($_SESSION['cart']);
                                                                                                                                                                                                          echo $cart_item;
                                                                                                                                                                                                        } else echo 0; ?></span></a>
          </div>
          <a class="menu-icon -navbar" href="#">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>