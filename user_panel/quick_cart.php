<div class="drawer drawer-right slide" id="cart-drawer" tabindex="-1" role="dialog" aria-labelledby="drawer-demo-title" aria-hidden="true">
    <div class="drawer-content drawer-content-scrollable" role="document">
        <div class="drawer-body">
            <div class="cart-sidebar">
                <div class="cart-items__wrapper">
                    <h2>Shopping cart</h2>
                    <?php

                    $total = 0;

                    if (isset($_GET['did'])) {
                        $did = $_GET['did'];
                        unset($_SESSION['cart'][$did]);
                        unset($_SESSION['qty'][$did]);
                    }

                    if (isset($_SESSION['cart'])) {

                        foreach ($_SESSION['cart'] as $key => $value) {
                            $quick_query = mysqli_query($connection, "select * from tbl_product where product_id=$value");
                            $quick_data = mysqli_fetch_array($quick_query);
                            $quick_qty = $_SESSION['qty'][$key];
                            $subtotal = $quick_data['product_price'] * $quick_qty;
                            $total += $subtotal;
                            echo "<div class='cart-item'>
                            <div class='cart-item__image'><img src='/admin_panel/html/" . $quick_data['product_img'] . "' alt='Product image' /></div>
                            <div class='cart-item__info'><a href='product_detail.php'>" . $quick_data['product_name'] . "</a>
                                <h5>&#8377; " . $quick_data['product_price'] . "</h5>
                                <p>Quantity:<span> " . $quick_qty . "</span></p>
                            </div><a class='cart-item__remove' href=''><i class='fal fa-times'></i></a>
                        </div>";
                        }
                    } else {
                        echo "<div class='mb-5'><p style='text-align:center; font-size: 20px; line-height: 100px;'>Cart is Empty</p></div>";
                    }

                    ?>
                    <div class="cart-items__total">
                        <div class="cart-items__total__price">
                            <h5>Total</h5><span>&#8377; <?php if(isset($_SESSION['cart'])){echo $total;} else echo "00"; ?></span>
                        </div>
                        <div class="cart-items__total__buttons"><a class="btn -white" href="cart.php">View cart</a><a class="btn -dark" href="checkout.php">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>