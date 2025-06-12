<?php

session_start();

if (!isset($_SESSION['customer_id'])) {
    echo "<script>alert('First you need to login')</script>";
    echo "<script>window.location.href='login.php'</script>";
  }  

$connection = mysqli_connect("localhost", "root", "", "projectdb");

$cid = $_SESSION['customer_id'];
//$cid = 5;

$customer_query = mysqli_query($connection, "select * from tbl_customer where customer_id=$cid ");
// For Upcoming Orders
$myorder_query = mysqli_query($connection, "SELECT * FROM tbl_order WHERE customer_id=$cid AND order_status = 'Pending'");

// For Order History
$order_history = mysqli_query($connection, "SELECT * FROM tbl_order WHERE customer_id=$cid AND (order_date <= NOW() OR order_status = 'Cancelled')");

// For Upcoming Appointments
$myappointment_query = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE customer_id=$cid AND appointment_date > NOW() AND `status` = 'Pending'");

// For Appointment History
$appointment_history = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE customer_id=$cid AND (`status` = 'Cancelled' OR `status` = 'Completed')");


$customer_data = mysqli_fetch_array($customer_query);
$id = $customer_data['customer_id'];
$img = $customer_data['cust_img'];
$fname = $customer_data['first_name'];
$lname = $customer_data['last_name'];
$gender = $customer_data['gender'];
$email = $customer_data['email'];
$contact = $customer_data['contact'];
$dob = $customer_data['DOB'];

if (isset($_POST['btn_updateProfile'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $update = mysqli_query($connection, "UPDATE `tbl_customer` SET `first_name`='$fname',`last_name`='$lname',`gender`='$gender',`DOB`='$dob',`contact`='$contact',`email`='$email' WHERE `customer_id` = $id");
    if ($update) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        mysqli_error($connection);
    }

    header("location:" . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['btn_changePassword'])) {
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];
    $old_pass = $_POST['old_password'];

    //check new password and confirm password are be same.
    if ($new_pass == $confirm_pass) {
        //check old password and new password are not be same
        if ($new_pass != $old_pass) {
            $update = mysqli_query($connection, "UPDATE `tbl_customer` SET `password`='$new_pass' WHERE customer_id='$id'");
            echo "<script>alert('Password updated successfully');</script>";
        } else {
            echo "<script>alert('OLD password and New password are not must be same');</script>";
        }
    } else {
        echo "<script>alert('Confirm password mismatch');</script>";
    }

    header("location:" . $_SERVER['PHP_SELF']);
    exit();
}
if (isset($_POST['btn_update_appoinment'])) {
    $appointment_id = $_POST['appointment_id'];
    $date = $_POST['reshedule_time'];

    // Now $appointment_id contains the appointment ID submitted from the form
    echo "<p>Appointment ID: " . $appointment_id . "</p>";
    $update = mysqli_query($connection, "UPDATE `tbl_appoinment` SET `date`='$date' WHERE `customer_id` = $appointment_id");
    if ($update) {
        echo "<script>alert('Record reshedule successfully');</script>";
    } else {
        mysqli_error($connection);
    }

    header("location:" . $_SERVER['PHP_SELF']);
    exit();
}


// Check if cancel appointment button is clicked
if (isset($_POST['btn_cancelAppointment'])) {
    $appointment_id = $_POST['appointment_id'];

    // Query to update appointment status to 'Cancelled'
    $cancel_appointment_query = "UPDATE tbl_appointment SET `status`='Cancelled' WHERE appointment_id=$appointment_id";

    // Execute the query
    $cancel_appointment_result = mysqli_query($connection, $cancel_appointment_query);

    // Check if the query executed successfully
    if ($cancel_appointment_result) {
        // Appointment cancelled successfully
        echo "<script>alert('Appointment cancelled successfully');</script>";
    } else {
        // Failed to cancel appointment
        echo "<script>alert('Failed to cancel appointment');</script>";
    }

    header("location:" . $_SERVER['PHP_SELF']);
    exit();
}


// Check if cancel appointment button is clicked
if (isset($_POST['btn_cancelOrder'])) {
    $order_id = $_POST['order_id'];

    // Query to update appointment status to 'Cancelled'
    $cancel_appointment_query = "UPDATE tbl_order SET order_status='Cancelled' WHERE order_id=$order_id";

    // Execute the query
    $cancel_appointment_result = mysqli_query($connection, $cancel_appointment_query);

    // Check if the query executed successfully
    if ($cancel_appointment_result) {
        // Appointment cancelled successfully
        echo "<script>alert('Appointment cancelled successfully');</script>";
    } else {
        // Failed to cancel appointment
        echo "<script>alert('Failed to cancel appointment');</script>";
    }

    header("location:" . $_SERVER['PHP_SELF']);
    exit();
}





?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>My account</title>
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
    <link rel="stylesheet" href="assets/css/myaccount.css" />
    <link rel="stylesheet" href="assets/css/profile.css" />


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
                <h2>My account</h2>
                <ul>
                    <li>Home</li>
                    <li style="color: #f44336;">my account</li>
                </ul>
            </div>
        </div>
        <div id="container">
            <div class="card">
                <div id="sidebar">
                    <div class="profile-info">
                        <?php
                        if (!empty($img)) {
                            // If the customer's image exists in the database, show that image
                            echo '<img src="../admin_panel/html/' . $img . '" alt="User Profile Picture" class="profile-pic">';
                        } else {
                            // If the customer's image doesn't exist in the database or is null, show a default image
                            echo '<img src="assets/images/customer_img/unknown.jpg" alt="User Profile Picture" class="profile-pic">';
                        }
                        ?>

                        <div>
                            <label for="profile-pic-upload">Change Profile Picture</label>
                            <input type="file" id="profile-pic-upload" style="display: none;">
                        </div>

                    </div>

                    <div class="divider"></div>
                    <div class="sidebar-option active" onclick="showContent('user-dashboard')">
                        <p>User Dashboard</p>
                    </div>
                    <div class="sidebar-option" onclick="showContent('update-profile')">
                        <p>Update profile</p>
                    </div>
                    <div class="sidebar-option" onclick="showContent('change-password')">
                        <p>Change Password</p>
                    </div>
                    <div class="sidebar-option" onclick="showContent('my-orders')">
                        <p>My Orders</p>
                    </div>
                    <div class="sidebar-option" onclick="showContent('order-history')">
                        <p>Order History</p>
                    </div>
                    <div class="sidebar-option" onclick="showContent('upcoming-appointments')">
                        <p>Upcoming Appointments</p>
                    </div>
                    <div class="sidebar-option" onclick="showContent('appointment-history')">
                        <p>Appointment History</p>
                    </div>
                    <div class="sidebar-option" onclick="showContent('appointment-history')">
                        <p><a href="logout.php" style="color:black; text-decoration :none;">Log out</a></p>
                    </div>
                </div>
                <div id="content">
                    <div id="navbar">
                        <h1>User Profile</h1>
                        <p>Welcome back, <?php $cust_name = $_SESSION['customer_name'];
                                            echo "$cust_name"; ?> !</p>
                    </div>
                    <div class="divider"></div>
                    <!-- Content sections -->
                    <div id="user-dashboard" class="content-section" style="margin-left: 1rem;">
                        <div class="customer-info">
                            <h2 style="margin-top: 3rem; margin-bottom:3rem;">My Profile </h2>
                            <div class="info-item">
                                <label for="customer-name">Customer ID:</label>
                                <p id="customer-name">#<?php echo $id; ?></p>
                            </div>
                            <div class="info-item">
                                <label for="customer-name">Name:</label>
                                <p id="customer-name"><?php echo "$fname $lname"; ?></< /p>
                            </div>
                            <div class="info-item">
                                <label for="customer-name">Gender:</label>
                                <p id="customer-name"><?php echo $gender; ?></< /p>
                            </div>
                            <div class="info-item">
                                <label for="customer-name">Date of birth:</label>
                                <p id="customer-name"><?php echo $dob; ?></< /p>
                            </div>

                            <div class="info-item">
                                <label for="customer-email">Email:</label>
                                <p id="customer-email"><?php echo $email; ?></< /p>
                            </div>
                            <div class="info-item">
                                <label for="customer-phone">Phone:</label>
                                <p id="customer-phone"><?php echo $contact; ?></< /p>
                            </div>
                            <!-- Add more customer information fields here as needed -->
                        </div>
                    </div>

                    <div id="update-profile" class="content-section" style="display: none;">
                        <form method="post">
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" id="firstname" name="firstname" value="<?php echo $fname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" id="lastname" name="lastname" value="<?php echo $lname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <select id="gender" name="gender">
                                    <option value="male" <?php if ($gender == "male" || $gender == "Male") {
                                                                echo "selected";
                                                            } ?>>Male</option>
                                    <option value="female" <?php if ($gender == "female" || $gender == "Female") {
                                                                echo "selected";
                                                            } ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact:</label>
                                <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" value="<?php echo $contact; ?>">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_updateProfile">Update</button>
                            </div>
                        </form>
                    </div>

                    <div id="change-password" class="content-section" style="display: none; padding-top: 1rem;">
                        <form method="post">
                            <div class="form-group">
                                <label for="firstname">Old password:</label>
                                <input type="text" id="firstname" name="old_password" placeholder="Enter your old Password">
                            </div>
                            <div class="form-group">
                                <label for="lastname">New password:</label>
                                <input type="text" id="lastname" name="new_password" placeholder="Enter new Password">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Confirm password:</label>
                                <input type="text" id="lastname" name="confirm_password" placeholder="Confirm password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_changePassword">Change password</button>
                                <button class="btn -red" type="reset" name="btn_changePassword" style="margin-left: 1rem; background-color:red;">Reset</button>
                            </div>
                        </form>
                    </div>

                    <div id="my-orders" class="content-section" style="display: none;">
                        <h2 style="margin-top: 3rem; margin-bottom:3rem;">My Orders</h2>
                        <table>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            while ($order_data = mysqli_fetch_array($myorder_query)) {
                                echo "
                                <tr>
                                <td>#" . $order_data['order_id'] . "</td>
                                <td>" . $order_data['order_date'] . "</td>
                                <td>";
                                if ($order_data['order_status'] == 'Pending' || $order_data['order_status'] == 'pending') {
                                    echo "<div class='status-pills'>
                                            <span class='warning-pill'>Pending</span>
                                         </div>";
                                }
                                if ($order_data['order_status'] == 'Completed' || $order_data['order_status'] == 'completed') {
                                    echo "<div class='status-pills'>
                                            <span class='success-pill'>Completed</span>
                                         </div>";
                                }
                                if ($order_data['order_status'] == 'Cancelled' || $order_data['order_status'] == 'cancelled') {
                                    echo "<div class='status-pills'>
                                            <span class='danger-pill'>Cancelled</span>
                                         </div>";
                                }
                                echo "</td>
                                <td>
                                <form method='post'>
                                <input type='hidden' name='order_id' value='" . $order_data['order_id'] . "'>
                                <button type='submit' name='btn_cancelOrder' class='cancel-button'>Cancel</button>
                                <a href='invoice.php?oid={$order_data['order_id']}' name='btn_cancelOrder' class='btn btn-outline-info btn-sm cancel-button'>View</a>

                            </form>
                            </td>
                            </tr>
                                ";
                            }
                            ?>

                        </table>
                    </div>

                    <div id="order-history" class="content-section" style="display: none;">
                        <h2 style="margin-top: 3rem; margin-bottom:3rem;">Order History</h2>
                        <table>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            while ($order_data = mysqli_fetch_array($order_history)) {
                                echo "
                                <tr>
                                <td>#" . $order_data['order_id'] . "</td>
                                <td>" . $order_data['order_date'] . "</td>
                                <td>";
                                if ($order_data['order_status'] == 'Pending' || $order_data['order_status'] == 'pending') {
                                    echo "<div class='status-pills'>
                                            <span class='warning-pill'>Pending</span>
                                         </div>";
                                }
                                if ($order_data['order_status'] == 'Completed' || $order_data['order_status'] == 'completed') {
                                    echo "<div class='status-pills'>
                                            <span class='success-pill'>Completed</span>
                                         </div>";
                                }
                                if ($order_data['order_status'] == 'Cancelled' || $order_data['order_status'] == 'cancelled') {
                                    echo "<div class='status-pills'>
                                            <span class='danger-pill'>Cancelled</span>
                                         </div>";
                                }
                                echo "</td>
                                <td>                    
                                <a href='invoice.php?oid={$order_data['order_id']}' name='btn_cancelOrder' class='btn btn-outline-info btn-sm cancel-button'>View</a>
                                </td>
                            </tr>
                                ";
                            }
                            ?>
                        </table>
                    </div>

                    <div id="upcoming-appointments" class="content-section" style="display: none;">
                        <h2 style="margin-top: 3rem; margin-bottom:3rem;">Upcoming appointments</h2>
                        <table>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            while ($appointment_data = mysqli_fetch_array($myappointment_query)) {
                                echo "
                                    <tr>
                                        <td>#" . $appointment_data['appointment_id'] . "</td>
                                        <td>" . $appointment_data['service'] . "</td>
                                        <td>" . $appointment_data['appointment_date'] . "</td>
                                        <td>";
                                if ($appointment_data['status'] == 'Pending' || $appointment_data['status'] == 'pending') {
                                    echo "<div class='status-pills'>
                                            <span class='warning-pill'>Pending</span>
                                         </div>";
                                }
                                if ($appointment_data['status'] == 'Completed' || $appointment_data['status'] == 'completed') {
                                    echo "<div class='status-pills'>
                                            <span class='success-pill'>Completed</span>
                                         </div>";
                                }
                                if ($appointment_data['status'] == 'Cancelled' || $appointment_data['status'] == 'cancelled') {
                                    echo "<div class='status-pills'>
                                            <span class='danger-pill'>Cancelled</span>
                                         </div>";
                                }
                                echo "</td>
                                        <td>
                                            <form method='post'>
                                                <input type='hidden' name='appointment_id' value='" . $appointment_data['appointment_id'] . "'>
                                                <button type='submit' name='btn_cancelAppointment' class='cancel-button'>Cancel</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </table>
                    </div>

                    <div id="appointment-history" class="content-section" style="display: none;">
                        <h2 style="margin-top: 3rem; margin-bottom:3rem;">Appointment history</h2>
                        <table>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            while ($appointment_data = mysqli_fetch_array($appointment_history)) {
                                echo "
                                <tr>
                                <td>#" . $appointment_data['appointment_id'] . "</td>
                                <td>" . $appointment_data['service'] . "</td>
                                <td>" . $appointment_data['appointment_date'] . "</td>
                                <td>";
                                if ($appointment_data['status'] == 'Pending' || $appointment_data['status'] == 'pending') {
                                    echo "<div class='status-pills'>
                                            <span class='warning-pill'>Pending</span>
                                         </div>";
                                }
                                if ($appointment_data['status'] == 'Completed' || $appointment_data['status'] == 'completed') {
                                    echo "<div class='status-pills'>
                                            <span class='success-pill'>Completed</span>
                                         </div>";
                                }
                                if ($appointment_data['status'] == 'Cancelled' || $appointment_data['status'] == 'cancelled') {
                                    echo "<div class='status-pills'>
                                            <span class='danger-pill'>Cancelled</span>
                                         </div>";
                                }
                                echo "</td>
                            </tr>
                                ";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php
        include "footer.php";
        ?>
        <!-- / footer -->
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

    <script>
        function showContent(sectionId) {
            // Hide all content sections
            var contentSections = document.querySelectorAll('.content-section');
            contentSections.forEach(function(section) {
                section.style.display = 'none';
            });

            // Show selected content section
            var selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';

            // Highlight active sidebar option
            var sidebarOptions = document.querySelectorAll('.sidebar-option');
            sidebarOptions.forEach(function(option) {
                option.classList.remove('active');
            });

            var activeOption = document.querySelector("[onclick*='" + sectionId + "']");
            activeOption.classList.add('active');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rescheduleButtons = document.querySelectorAll('.success-button');
            var updateAppointmentDiv = document.getElementById('update-appointment');

            rescheduleButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    updateAppointmentDiv.style.display = 'block';
                });
            });
        });
    </script>


</body>

</html>