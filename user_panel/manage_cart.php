<?php

session_start();

if (isset($_SESSION['customer_id'])) {

    if (isset($_POST['btn_cart'])) {

        $pid = $_POST['pid'];
        $product_qty = $_POST['quantity'];

        if (isset($_SESSION['cart'])) {

            $current_index = $_SESSION['counter'] + 1;
            $_SESSION['cart'][$current_index] = $pid;
            $_SESSION['qty'][$current_index] = $product_qty;
            $_SESSION['counter'] = $current_index;
            echo "<script>alert('Item added into cart');</script>";
            header("location:cart.php");
        } else {
            $product_cart = array();
            $qty = array();

            $_SESSION['cart'][0] = $pid;
            $_SESSION['qty'][0] = $product_qty;
            $_SESSION['counter'] = 0;
            echo "<script>alert('Item added into cart');</script>";
            header("location:cart.php");
        }
    }
    if (isset($_POST['btn_wishlist'])) {

        $product_id = $_POST['pid'];
        $customer_id =$_SESSION['customer_id'];

        $connecion = mysqli_connect("localhost","root","","projectdb");
        $wishlist_query=mysqli_query($connecion,"INSERT INTO `tbl_wishlist`(`customer_id`, `product_id`) VALUES ('$customer_id','$product_id')");

        echo "<script>alert('Item added into wishlist');</script>";
        echo "<script>window.location.href='shop.php';</script>";

    }
} else {
    echo "<script>alert('First you need to login to add product in cart')</script>";
    echo "<script>window.location.href='login.php'</script>";
}
