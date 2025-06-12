<?php
if (isset($_GET['pid'])) {

  $pid = $_GET['pid'];

  $connection = mysqli_connect("localhost", "root", "", "projectdb");

  $query = mysqli_query($connection, "select * from tbl_product where product_id='$pid'");

  $product = mysqli_fetch_array($query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Product Detail</title>
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
  <style>
    input[type="number"] {
      /* Additional styles for Firefox */
      -moz-appearance: textfield;
    }

    /* Hide the default number input spinner */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
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
          <li>Shop</li>
          <li class="active">Product Detail</li>
        </ul>
      </div>
    </div>
    <div class="shop">
      <div class="container">
        <div class="product-detail__wrapper">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="product-detail__slide-two">
                <div class="product-detail__slide-two__big">
                  <div class="slider__item"><img style="height: 700px;" src="/admin_panel/html/<?php echo $product['product_img']; ?>" alt="Product image" /></div>
                  <div class="slider__item"><img src="assets/images/product/2.png" alt="Product image" /></div>
                  <div class="slider__item"><img src="assets/images/product/3.png" alt="Product image" /></div>
                  <div class="slider__item"><img src="assets/images/product/4.png" alt="Product image" /></div>
                </div>
                <div class="product-detail__slide-two__small">
                  <div class="slider__item"><img src="assets/images/product/1.png" alt="Product image" /></div>
                  <div class="slider__item"><img src="/admin_panel/html/<?php echo $product['product_img']; ?>" alt="Product image" /></div>
                  <div class="slider__item"><img src="assets/images/product/3.png" alt="Product image" /></div>
                  <div class="slider__item"><img src="assets/images/product/4.png" alt="Product image" /></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="product-detail__content">
                <div class="product-detail__content">
                  <div class="product-detail__content__header">
                    <h5>eyes</h5>
                    <h2><?php echo "{$product['product_name']}"; ?></h2>

                  </div>
                  <div class="product-detail__content__header__comment-block">
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    <p>03 review</p><a href="#">Write a reviews</a>
                  </div>
                  <h3>&#8377;<?php echo $product['product_price']; ?></h3>
                  <div class="divider"></div>
                  <div class="product-detail__content__footer">
                    <ul>
                      <li>Brand:gucci
                      </li>
                      <li>Product code: PM 01
                      </li>
                      <li>Availability: In Stock</li>
                    </ul>
                    <div class="product-detail__colors"><span>size:</span>
                      <div class="product-detail__colors__item" style="background-color: #8B0000"></div>
                      <div class="product-detail__colors__item" style="background-color: #4169E1"></div>
                    </div>
                    <form method="post" action="manage_cart.php">
                      <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                      <div class="product-detail__controller">
                        <div class="quantity-controller -border -round">
                            <button type="button" class="quantity-controller__btn -decrease">-</button>
                              <input type="number" class="quantity-controller__number" value="1" name="quantity" min="1" max="10" data-counter/>
                            <button type="button" class="quantity-controller__btn -increase">+</button>
                        </div>
                        <div class="add-to-cart -dark"><button type="submit" name="btn_cart" class="btn -round -red"><i class="fas fa-shopping-bag"></i></button>
                          <h5>Add to cart</h5>
                        </div>
                        <div class="product-detail__controler__actions"></div><button type="submit" class="btn -round -white"><i class="fas fa-heart"></i></button>
                      </div>
                    </form>
                    <div class="divider"></div>
                    <div class="product-detail__content__tab">
                      <ul class="tab-content__header">
                        <li class="tab-switcher" data-tab-index="0" tabindex="0">Description</li>
                        <li class="tab-switcher" data-tab-index="1" tabindex="0">Shipping & Returns</li>
                        <li class="tab-switcher" data-tab-index="2" tabindex="0">Reviews ( 03 )</li>
                      </ul>
                      <div id="allTabsContainer">
                        <div class="tab-content__item -description" data-tab-index="0">
                          <p><?php echo $product['description']; ?></p>
                        </div>
                        <div class="tab-content__item -ship" data-tab-index="1" style="display:none;">
                          <h5><span>Ship to</span>New york</h5>
                          <ul>
                            <li>Standard Shipping on order over 0kg - 5kg. <span>+10.00</span></li>
                            <li>Heavy Goods Shipping on oder over 5kg-10kg . <span>+20.00</span></li>
                          </ul>
                          <h5>Delivery &amp; returns</h5>
                          <p>We diliver to over 100 countries around the word. For full details of the delivery options
                            we offer, please view our Delivery information.</p>
                        </div>
                        <div class="tab-content__item -review" data-tab-index="2" style="display:none;">
                          <div class="review">
                            <div class="review__header">
                              <div class="review__header__avatar"><img src="../../../i1.wp.com/metro.co.uk/wp-content/uploads/2020/03/GettyImages-1211127989bb31.jpg?quality=90&amp;strip=all&amp;zoom=1&amp;resize=644%2C416&amp;ssl=1" alt="Reviewer avatar" /></div>
                              <div class="review__header__info">
                                <h5>Lionel Messi</h5>
                                <p>Mar 17, 2020</p>
                              </div>
                              <div class="review__header__rate">
                                <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                              </div>
                            </div>
                            <p class="review__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                              eiusmod tempor incididunt ut labore et dolore.</p><a class="review__report" href="#">Report as Inappropriate</a>
                          </div>
                          <form>
                            <h5>Write a review</h5>
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="input-validator">
                                  <input type="text" name="name" placeholder="Name" />
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="input-validator">
                                  <input type="text" name="email" placeholder="Email" />
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="input-validator">
                                  <textarea name="message" placeholder="Message" rows="5"></textarea>
                                </div><span class="input-error"></span>
                              </div>
                              <div class="col-12">
                                <button class="btn -dark">Write a review
                                </button>
                              </div>
                            </div>
                          </form>
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
    <div class="product-slide">
      <div class="container">
        <div class="section-title -center" style="margin-bottom: 1.875em">
          <h2>Related product</h2>
        </div>
        <div class="product-slider">
          <div class="product-slide__wrapper">
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type">
                  <h5 class="-new">New</h5>
                </div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/1.png" alt="Product image" /><img src="assets/images/product/2.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">eyes</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">The expert mascaraa</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$35.00</h5>
                    <div class="product-colors">
                      <div class="product-colors__item" style="background-color: #8B0000"></div>
                      <div class="product-colors__item" style="background-color: #4169E1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type"></div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/2.png" alt="Product image" /><img src="assets/images/product/3.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">eyes</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">Velvet Melon High Intensity</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$38.00</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type">
                  <h5 class="-sale">-15%</h5>
                </div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/3.png" alt="Product image" /><img src="assets/images/product/4.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">eyes</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">Leather shopper bag</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$30.00</h5>
                    <h5 class="product-price--discount">$35.00</h5>
                    <div class="product-colors">
                      <div class="product-colors__item" style="background-color: #8B0000"></div>
                      <div class="product-colors__item" style="background-color: #4169E1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type"></div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/4.png" alt="Product image" /><img src="assets/images/product/5.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">eyes</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">Luxe jewel lipstick</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$38.00</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type">
                  <h5 class="-sale">-50%</h5>
                </div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/5.png" alt="Product image" /><img src="assets/images/product/6.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">face</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">Penpoint seamless beauty</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$20.00</h5>
                    <h5 class="product-price--discount">$40.00</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type"></div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/7.png" alt="Product image" /><img src="assets/images/product/8.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">face</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">The Sneaky lips</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$38.00</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type"></div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/8.png" alt="Product image" /><img src="assets/images/product/9.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">face</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">White Facial Cream</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$38.00</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-slide__item">
              <div class="product ">
                <div class="product-type"></div>
                <div class="product-thumb"><a class="product-thumb__image" href="product-detail.html"><img src="assets/images/product/9.png" alt="Product image" /><img src="assets/images/product/10.png" alt="Product image" /></a>
                  <div class="product-thumb__actions">
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-atc" href="#"><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round product-qv" href="#"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="product-btn"><a class="btn -white product__actions__item -round" href="#"><i class="fas fa-heart"></i></a>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-content__header">
                    <div class="product-category">face</div>
                    <div class="rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                  </div><a class="product-name" href="product-detail.html">Orange Massage Cream</a>
                  <div class="product-content__footer">
                    <h5 class="product-price--main">$55.00</h5>
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

    s
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