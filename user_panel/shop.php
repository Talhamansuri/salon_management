<?php

$connection = mysqli_connect("localhost", "root", "", "projectdb");


$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

switch ($sort) {
  case 'az':
    $sort_query = "ORDER BY product_name ASC";
    break;
  case 'za':
    $sort_query = "ORDER BY product_name DESC";
    break;
  case 'low-high':
    $sort_query = "ORDER BY product_price ASC";
    break;
  case 'high-low':
    $sort_query = "ORDER BY product_price DESC";
    break;
  default:
    $sort_query = "";
}


if (isset($_GET['cat_id'])) {
  $cat_id = $_GET['cat_id'];
  $grid_query = mysqli_query($connection, "SELECT * FROM `tbl_product` JOIN tbl_product_category ON tbl_product.category_id = tbl_product_category.category_id WHERE tbl_product.category_id='$cat_id'");
  $list_query = mysqli_query($connection, "SELECT * FROM `tbl_product` JOIN tbl_product_category ON tbl_product.category_id = tbl_product_category.category_id WHERE tbl_product.category_id='$cat_id'");
} elseif (isset($_GET['search'])) {

  $search = $_GET['search'];

  $grid_query = mysqli_query($connection, "SELECT * FROM `tbl_product` WHERE product_name like '%$search%'");
  $list_query = mysqli_query($connection, "SELECT * FROM `tbl_product` WHERE product_name like '%$search%'");
} elseif (isset($_GET['from_price']) && isset($_GET['to_price'])) {
  $from = $_GET['from_price'];
  $to = $_GET['to_price'];

  $grid_query = mysqli_query($connection, "SELECT * FROM `tbl_product` WHERE product_price between $from and $to");
  $list_query = mysqli_query($connection, "SELECT * FROM `tbl_product` WHERE product_price between $from and $to");
} else {
  $grid_query = mysqli_query($connection, "SELECT * FROM tbl_product JOIN tbl_product_category ON tbl_product.category_id = tbl_product_category.category_id $sort_query");
  $list_query = mysqli_query($connection, "SELECT * FROM tbl_product JOIN tbl_product_category ON tbl_product.category_id = tbl_product_category.category_id $sort_query");
  }

$count = mysqli_num_rows($grid_query);
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Shop</title>
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
    <div class="breadcrumb">
      <div class="container">
        <h2>Shop</h2>
        <ul>
          <li>Home</li>
          <li class="active">Shop</li>
        </ul>
      </div>
    </div>
    <div class="shop">
      <div class="container-full-half">
        <div class="row">
          <div class="mr-5 ml-5">
            <div class="shop-header">
              <div class="shop-header__view">
                <div class="shop-header__view__icon"><a class="active" href="#"><i class="fas fa-th"></i></a><a href="#"><i class="fas fa-bars"></i></a></div>
                <h5 class="shop-header__page">Shop Grid view</h5>
              </div>
              <select id="sorting" class="customed-select" name="sorting">
                <option value="">Sorting Filter</option>
                <option value="az">A to Z</option>
                <option value="za">Z to A</option>
                <option value="low-high">Low to High Price</option>
                <option value="high-low">High to Low Price</option>
              </select>
            </div>
            <div class="shop-products">
              <div class="shop-products__gird">
                <div class="row mx-n1 mx-xl-n3">
                  <?php
                  while ($grid_data = mysqli_fetch_array($grid_query)) {
                    echo "<div class='col-6 col-lg-4 col-xl-3 px-1 px-xl-3'>
                              <div class='product '>
                                  <form method='post' action='manage_cart.php'>
                                      <input type='hidden' name='pid' value=" . $grid_data['product_id'] . ">
                                      <input type='hidden' name='quantity' value='1'>
                                      <div class='product-type'>
                                      </div>
                                      <div class='product-thumb'><a class='product-thumb__image' href='product_details.php?pid={$grid_data['product_id']}'><img style='height: 350px;' src='../admin_panel/html/{$grid_data['product_img']}' alt='Product image' /><img style='height: 350px;' src='../admin_panel/html/{$grid_data['product_img']}' alt='Product image' /></a>
                                          <div class='product-thumb__actions'>
                                              <div class='product-btn'><button type='submit' name='btn_cart' class='btn -white product__actions__item -round product-atc'><i class='fas fa-shopping-bag'></i></button>
                                              </div>
                                              <div class='product-btn'><button class='btn -white product__actions__item -round product-qv'><i class='fas fa-eye'></i></button>
                                              </div>
                                              <div class='product-btn'><button type='submit' name='btn_wishlist' class='btn -white product__actions__item -round'><i class='fas fa-heart'></i></button>
                                              </div>
                                          </div>
                                      </div>
                                      <div class='product-content'>
                                          <div class='product-content__header'>
                                              <div class='product-category'>" . $grid_data['category_name'] . "</div>
                                              <div class='rate'><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i></div>
                                          </div><a class='product-name' href='product_details.php?pid={$grid_data['product_id']}'>" . $grid_data['product_name'] . "</a>
                                          <div class='product-content__footer'>
                                              <h5 class='product-price--main'>&#8377;" . $grid_data['product_price'] . "</h5>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>";
                  }
                  ?>
                </div>
              </div>
              <div class="shop-products__list">
                <div class="row">
                  <?php
                  while ($list_data = mysqli_fetch_array($list_query)) {
                    echo "<div class='col-12'>
                              <div class='product-list'>
                                  <div class='product-list-thumb'>
                                      <div class='product-type'>
                                          <h5 class='-new'>New</h5>
                                      </div><a class='product-list-thumb__image' href='product_details.php'><img src='/admin_panel/html/{$list_data['product_img']}' alt='Product image' /></a>
                                  </div>
                                  <div class='product-list-content'>
                                    <form method='post' action='manage_cart.php'>
                                      <input type='hidden' name='pid' value=" . $list_data['product_id'] . ">
                                      <input type='hidden' name='quantity' value='1'>
                                        <div class='product-list-content__top'>
                                            <div class='product-category__wrapper'>
                                                <h5 class='product-category'>" . $list_data['category_name'] . "</h5>
                                                <div class='rate'><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='far fa-star'></i></div>
                                            </div><a class='product-name' href='product_details.php'>" . $list_data['product_name'] . "</a>
                                            <div class='product__price'>
                                                <div class='product__price__wrapper'>
                                                    <h5 class='product-price--main'>&#8377;" . $list_data['product_price'] . "</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='product-list-content__bottom'>
                                            <p class='product-description'>" . $list_data['description'] . "</p>
                                              <div class='product-actions'>
                                                  <div class='product-btn'>
                                                      <div class='add-to-cart'><button type='submit' name='btn_cart' class='btn -round -red'><i class='fas fa-shopping-bag'></i></button>
                                                          <h5>Add to cart</h5>
                                                      </div>
                                                  </div>
                                                  <div class='product-btn'><a class='btn -white product__actions__item -round' href='#'><i class='fas fa-heart'></i></a>
                                                  </div>
                                              </div>
                                        </div>
                                    </form>
                                  </div>
                              </div>
                           </div>";
                  }
                  ?>
                </div>
              </div>
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


  <script>
    document.getElementById("sorting").addEventListener("change", function() {
      const selectedValue = this.value;

      switch (selectedValue) {
        case "az":
          window.location.href = "shop.php?sort=az"; 
          break;
        case "za":
          window.location.href = "shop.php?sort=za";
          break;
        case "low-high":
          window.location.href = "shop.php?sort=low-high";
          break;
        case "high-low":
          window.location.href = "shop.php?sort=high-low";
          break;
      }
    });
  </script>


  <!--build:js assets/js/main.min.js-->
  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <script src="assets/js/parallax.min.js"></script>
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/jquery.validate.min.js"></script>
  <script src="assets/js/jquery.modal.min.js"></script>
  <script src="assets/js/bootstrap-drawer.min.js"></script>
  <script src="assets/js/jquery.countdown.min.js"></script>
  <script src="assets/js/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


  <!--endbuild-->
</body>

</html>