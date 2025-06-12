<?php

session_start();
if (!isset($_SESSION['id'])) {
  header("location:auth-login.php");
}

require "connection.php";

$customer = mysqli_query($connection, "SELECT * FROM tbl_customer");
$product = mysqli_query($connection, "SELECT * FROM tbl_product");
$order = mysqli_query($connection, "SELECT * FROM tbl_order WHERE order_status='pending' OR order_status='Pending' ");
$appointment = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE `status`='pending' OR `status`='Pending' ");
$todays_task = mysqli_query($connection, "SELECT * FROM tbl_appointment JOIN tbl_service_category ON tbl_appointment.service=tbl_service_category.category_id WHERE appointment_date > NOW() AND (`status`='Pending' OR `status`='Pending') ");


$count_appointment = mysqli_num_rows($todays_task);
$count_product = mysqli_num_rows($product);
$count_customer = mysqli_num_rows($customer);
$count_order = mysqli_num_rows($order);


if (isset($_GET['cid'])) {
  $cid = $_GET['cid'];
  $update_query = mysqli_query($connection, "UPDATE `tbl_appointment` SET `status`='Completed' WHERE appointment_id=$cid");
}

if (isset($_GET['rid'])) {
  $rid = $_GET['rid'];
  $update_query = mysqli_query($connection, "UPDATE `tbl_appointment` SET `status`='Cancelled' WHERE appointment_id=$rid");
}


?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Index page</title>

  <meta name="description" content="" />

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
  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
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
            <div class="row gy-4">
              <!-- Congratulations card -->
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-1">Welcome Back <?php echo $_SESSION['name']; ?> 🎉</h4>
                    <p class="pb-0"><br />complete Today's Task</p>
                    <a href="appointment_list.php" class="btn btn-sm btn-primary">View Appointment</a>
                    <a href="customer_list.php" class="btn btn-sm btn-primary">View Customer</a>
                    <a href="order_list.php" class="btn btn-sm btn-primary">View Order</a>

                  </div>
                </div>
              </div>
              <!--/ Congratulations card -->

              <!-- Transactions -->
              <div class="col">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Transactions</h5>
                    </div>
                    <p class="mt-3"><span class="fw-medium">Total 48.5% growth</span> 😎 this month</p>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                          <div class="avatar">
                            <div class="avatar-initial bg-primary rounded shadow">
                              <i class="bi bi-bag-plus"></i>
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                              </svg>
                            </div>
                          </div>
                          <div class="ms-3">
                            <div class="small mb-1">Today's appointment</div>
                            <h5 class="mb-0"><?php echo $count_appointment; ?></h5>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                          <div class="avatar">
                            <div class="avatar-initial bg-success rounded shadow">
                              <i class="mdi mdi-account-outline mdi-24px"></i>
                            </div>
                          </div>
                          <div class="ms-3">
                            <div class="small mb-1">Total Customers</div>
                            <h5 class="mb-0"><?php echo $count_customer; ?></h5>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                          <div class="avatar">
                            <div class="avatar-initial bg-warning rounded shadow">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                              </svg>
                            </div>
                          </div>
                          <div class="ms-3">
                            <div class="small mb-1">Total Product</div>
                            <h5 class="mb-0"><?php echo $count_product; ?></h5>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                          <div class="avatar">
                            <div class="avatar-initial bg-info rounded shadow">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                              </svg>
                            </div>
                          </div>
                          <div class="ms-3">
                            <div class="small mb-1">Pending Order</div>
                            <h5 class="mb-0"><?php echo $count_order; ?></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Transactions -->
              <!-- Data Tables -->
              <div class="col-12">
                <div class="card">
                  <div class="table-responsive">
                    <?php

                    if ($count_appointment > 0) {
                    ?>
                      <table class="table">
                        <thead class="table-light">
                          <tr>
                            <th>#ID</th>
                            <th>Customer name</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Service</th>
                            <th>Date-Time</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-1">
                          <?php
                          while ($appointment = mysqli_fetch_array($todays_task)) {
                            echo "<tr>
                                            <td>#{$appointment['appointment_id']}</td>
                                            <td class='sorting_1'>
                                                <div class='d-flex justify-content-start align-items-center product-name'>
                                                    <div class='d-flex flex-column'><span class='text-nowrap text-heading fw-medium'>{$appointment['first_name']} {$appointment['last_name']}</span><small class='text-truncate d-none d-sm-block'>{$appointment['email']}</small></div>
                                                </div>
                                            </td>
                                            <td>{$appointment['contact']}</td>
                                            <td>{$appointment['gender']}</td>
                                            <td>{$appointment['category_name']}</td>
                                            <td>{$appointment['appointment_date']}</td>";
                            echo "<td>";
                            if ($appointment['status'] == 'completed' || $appointment['status'] == 'Completed') {
                              echo "<span class='badge rounded-pill bg-label-success'>Completed</span>";
                            } elseif ($appointment['status'] == 'pending' || $appointment['status'] == 'Pending') {
                              echo "<span class='badge rounded-pill bg-label-warning'>Pending</span>";
                            } elseif ($appointment['status'] == 'cancelled' || $appointment['status'] == 'Cancelled') {
                              echo "<span class='badge rounded-pill bg-label-danger'>Cancelled</span>";
                            }
                            echo "</td>
                                  <td>{$appointment['message']}</td>
                                  <td>
                                      <div class='dropdown'>
                                          <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                              <i class='mdi mdi-dots-vertical'></i>
                                          </button>
                                          <div class='dropdown-menu'>
                                              <a class='dropdown-item' href='index.php?cid={$appointment['appointment_id']}'><i class='mdi mdi-pencil-outline me-1'></i> Accept</a>
                                              <a class='dropdown-item' href='index.php?rid={$appointment['appointment_id']}'><i class='mdi mdi-trash-can-outline me-1'></i> Reject</a>
                                          </div>
                                      </div>
                                  </td>
                              </tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!--/ Data Tables -->
            </div>
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
  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>