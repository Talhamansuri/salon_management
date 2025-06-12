<?php
$connection = mysqli_connect("localhost", "root", "", "projectdb");


# Include the necessary files for PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if (isset($_GET['did'])) {
    mysqli_query($connection, "delete from tbl_order where order_id='$_GET[did]'");
    mysqli_query($connection, "delete from tbl_order_details where order_id='$_GET[did]'");
} else {
    mysqli_error($connection);
}

if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $update_query = mysqli_query($connection, "UPDATE `tbl_order` SET `order_status`='Completed' WHERE order_id=$cid");

}

if (isset($_GET['rid'])) {
    $rid = $_GET['rid'];
    $update_query = mysqli_query($connection, "UPDATE `tbl_order` SET `order_status`='Cancelled' WHERE order_id=$rid");

}

function sendEmail($recipient, $subject, $message) {
    $mail = new PHPMailer(true); // PHPMailer instance
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'glamsalon001@gmail.com';
    $mail->Password   = 'lhwk cnwu wcrc hocc';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Set email content
    $mail->setFrom('glamsalon001@gmail.com', 'Glam Salon');
    $mail->addAddress($recipient);
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Error handling for sending emails
    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}

// Process status update for confirmed orders
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $update_query = mysqli_query($connection, "UPDATE `tbl_order` SET `order_status`='Completed' WHERE order_id=$cid");

    // Get order details to send email
    $order = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM tbl_order WHERE order_id=$cid"));

    if ($order) {
        sendEmail(
            'furkanshaikh2138@gmail.com',
            'Order Confirmed',
            "Hello {$order['customer_name']},\nYour order with Order ID: {$order['order_id']} has been confirmed. Thank you for shopping with us."
        );
    }
    echo "<script>alert('order status updated')</script>";
    echo "<script>window.location.href='order_list.php'</script>";
}

// Process status update for cancelled orders
if (isset($_GET['rid'])) {
    $rid = $_GET['rid'];
    $update_query = mysqli_query($connection, "UPDATE `tbl_order` SET `order_status`='Cancelled' WHERE order_id=$rid");

    // Get order details to send email
    $order = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM tbl_order WHERE order_id=$rid"));

    if ($order) {
        sendEmail(
            'furkanshaikh2138@gmail.com',
            'Order Cancelled',
            "Hello {$order['customer_name']},\nUnfortunately, your order with Order ID: {$order['order_id']} has been cancelled. We apologize for any inconvenience. Please contact us for further assistance."
        );
    }
    echo "<script>alert('order status updated')</script>";
    echo "<script>window.location.href='order_list.php'</script>";
}


$query = mysqli_query($connection, "select * from tbl_order");

?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Order List</title>

    <meta name="description" content="" />

    <!-- Data table cdn-link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/materialdesignicons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js">
    </script>
    <script>
        function redirect() {
            window.location.href = "add_order.php";
        }
    </script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php
            include "sidebar.php";
            ?>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php
                include "navbar.php";
                ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Orders /</span> Order List</h4>

                        <hr class="my-5" />

                        <!-- Bootstrap Table with Header - Light -->
                        <div class="card">
                            <div class="table-responsive text-nowrap m-4">
                                <table class="table" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>Order Date</th>
                                            <th>Customer name</th>
                                            <th>Payment status</th>
                                            <th>Order status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php
                                        while ($col = mysqli_fetch_array($query)) {
                                            echo "<tr>
                                            <td><a href='order_details.php?record_id={$col['order_id']}'><span>#{$col['order_id']}</span></a></td>
                                            <td>{$col['order_date']}</td>
                                            <td class='sorting_1'>
                                                <div class='d-flex justify-content-start align-items-center product-name'>
                                                    <div class='d-flex flex-column'><span class='text-nowrap text-heading fw-medium'>{$col['first_name']} {$col['last_name']}</span><small class='text-truncate d-none d-sm-block'>{$col['email']}</small></div>
                                                </div>
                                            </td>";
                                            echo "<td>";
                                            if ($col['payment_status'] == 'completed' || $col['payment_status'] == 'Completed') {
                                                echo "<h6 class='mb-0 w-px-100 text-success'><i class='mdi mdi-circle mdi-14px me-2'></i>Completed</h6>";
                                            } elseif ($col['payment_status'] == 'pending' || $col['payment_status'] == 'Pending') {
                                                echo "<h6 class='mb-0 w-px-100 text-warning'><i class='mdi mdi-circle mdi-14px me-2'></i>Pending</h6>";
                                            } elseif ($col['payment_status'] == 'cancelled' || $col['payment_status'] == 'Cancelled') {
                                                echo "<h6 class='mb-0 w-px-100 text-danger'><i class='mdi mdi-circle mdi-14px me-2'></i>Cancelled</h6>";
                                            }
                                            echo "</td>";
                                            echo "<td>";
                                            if ($col['order_status'] == 'completed' || $col['order_status'] == 'Completed') {
                                                echo "<span class='badge rounded-pill bg-label-success'>Completed</span>";
                                            } elseif ($col['order_status'] == 'pending' || $col['order_status'] == 'Pending') {
                                                echo "<span class='badge rounded-pill bg-label-warning'>Pending</span>";
                                            } elseif ($col['order_status'] == 'cancelled' || $col['order_status'] == 'Cancelled') {
                                                echo "<span class='badge rounded-pill bg-label-danger'>Cancelled</span>";
                                            }
                                            echo "</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                        <i class='mdi mdi-dots-vertical'></i>
                                                    </button>
                                                    <div class='dropdown-menu'>
                                                        <a class='dropdown-item' href='order_details.php?record_id={$col['order_id']}'><i class='mdi mdi-pencil-outline me-1'></i> View Details</a>
                                                        <a class='dropdown-item' href='order_list.php?cid={$col['order_id']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                                                            <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z'/>
                                                            <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0'/>
                                                        </svg>  Completed                                                   
                                                      </a>
                                                      <a class='dropdown-item' href='order_list.php?rid={$col['order_id']}'><i class='mdi mdi-trash-can-outline me-1'></i> Cancelled</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Bootstrap Table with Header - Light -->

                        <hr class="my-5" />
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php
                    include "footer.php";
                    ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
<!-- datatabless jquery cdn link-->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</html>