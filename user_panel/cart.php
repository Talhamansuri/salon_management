<?php

session_start();
$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (!isset($_SESSION['customer_id'])) {
  echo "<script>alert('First you need to login')</script>";
  echo "<script>window.location.href='login.php'</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Cart</title>
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
        <h2>Cart</h2>
        <ul>
          <li>Home</li>
          <li>Shop</li>
          <li class="active">Cart</li>
        </ul>
      </div>
    </div>
    <div class="shop">
      <div class="container">
        <div class="cart">
          <div class="container">
            <div class="cart__table">
              <div class="cart__table__wrapper">
                <table>
                  <?php
                  if (isset($_GET['did'])) {
                    $did = $_GET['did'];
                    unset($_SESSION['cart'][$did]);
                    unset($_SESSION['qty'][$did]);
                  }

                  if (isset($_SESSION['cart'])) {
                    $total = 0;

                    echo "<colgroup>
                      <col style='width: 40%' />
                      <col style='width: 17%' />
                      <col style='width: 17%' />
                      <col style='width: 17%' />
                      <col style='width: 9%'/>
                    </colgroup>
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>";
                    foreach ($_SESSION['cart'] as $key => $value) {
                      $cart_query = mysqli_query($connection, "select * from tbl_product where product_id=$value");
                      $cart_data = mysqli_fetch_array($cart_query);
                      $qty = $_SESSION['qty'][$key];
                      $subtotal = $cart_data['product_price'] * $qty;
                      $total += $subtotal;
                      echo "<tr>
                                <td>
                                    <div class='cart-product'>
                                        <div class='cart-product__image'><img src='/admin_panel/html/" . $cart_data['product_img'] . "' alt='Product image' />
                                        </div>
                                        <div class='cart-product__content'>
                                            <h5>eyes</h5><a href='product-detail.html'>" . $cart_data['product_name'] . "</a>
                                        </div>
                                    </div>
                                </td>
                                <td>" . $cart_data['product_price'] . "</td>
                                <td>
                                    <div class='quantity-controller'>
                                      <button type='button' class='quantity-controller__btn -decrease'>-</button>
                                      <label>
                                        <input type='number' class='quantity-controller__number' value=" . $qty . " name='quantity' min='1' max='10' data-counter />
                                      </label>
                                      <button type='button' class='quantity-controller__btn -increase'>+</button>
                                    </div>
                                </td>
                                <td>" . $subtotal . "</td>
                                <td><a href='?did=" . $key . "'><i class='fal fa-times'></i></a></td>
                              </tr>";
                    }
                  } else {
                    echo "<div class='mb-5'><p style='text-align:center; font-size: 20px; line-height: 100px;'>Cart is Empty</p></div>";
                  }
                  echo "</tbody>";
                  ?>
                </table>
              </div>
              <div class="cart__table__footer"><a href="shop.php"><i class="fal fa-long-arrow-left"></i>Continue Shopping</a><a href="#"><i class="fal fa-trash"></i>Clear Shopping Cart</a></div>
            </div>
            <div class="cart__total">
              <div class="cart__total__content">
                <form method="post">
                  <h3>Cart</h3>
                  <table>
                    <tbody>
                      <tr>
                        <th>Subtotal</th>
                        <td>&#8377;<?php $_SESSION['total'] = $total;
                                    if (isset($_SESSION['cart'])) {
                                      echo $total;
                                    } else echo "00.00"; ?></td>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <td class="final-price">&#8377;<?php if (isset($_SESSION['cart'])) {
                                                          $_SESSION['total'] = $total;
                                                          echo $total;
                                                        } else echo "00.00"; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="checkout.php" class="btn -red">Proceed to checkout</a>
                </form>
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
</body>

</html>