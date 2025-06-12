<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("location:auth-login.php");
}

$conn = mysqli_connect("localhost", "root", "", "projectdb");

$id = $_SESSION['id'];
$q = mysqli_query($conn, "select * from tbl_admin where admin_id='$id'");
$row = mysqli_fetch_array($q);

$fname = $row['first_name'];
$lname = $row['last_name'];
$gender = $row['gender'];
$dob = $row['DOB'];
$email = $row['email'];
$contact = $row['contact'];
$img = $row['admin_img'];
if (isset($_POST['btn_delete'])) {
  mysqli_query($conn, "delete from tbl_admin where admin_id='$id'");
  echo "<script>alert('account was deleted');</script>";
  header("location:auth-login.php");
}

if (isset($_POST['btn_submit'])) {

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];

  $update = mysqli_query($conn, "UPDATE `tbl_admin` SET `first_name`='$fname',`last_name`='$lname',`gender`='$gender',`DOB`='$dob',`email`='$email',`contact`='$contact' WHERE admin_id=$id");
  if ($update) {
    echo "<script>alert('updated successfully');</script>";
  } else {
    mysqli_error($conn);
  }
}
?>


<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Account settings</title>

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
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <h4 class="card-header">Profile Details</h4>
                  <!-- Account -->
                  <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <img src="<?php echo $img; ?>" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />

                    </div>
                  </div>
                  <div class="card-body pt-2 mt-1">
                    <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
                      <div class="row mt-2 gy-4">
                        <div class="col-md-6">
                          <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" name="fname" value="<?php echo $fname; ?>" autofocus />
                            <label for="firstName">First Name</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" name="lname" value="<?php echo $lname; ?>" />
                            <label for="lastName">Last Name</label>
                          </div>
                        </div>

                        <div class="col-md mb-3">
                          <small class="text-light fw-medium d-block">Gender</small>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Male" <?php if ($gender == "Male") {
                                                                                                                                                  echo "checked";
                                                                                                                                                } ?> required />
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Female" <?php if ($gender == "Female") {
                                                                                                                                                    echo "checked";
                                                                                                                                                  } ?> required />
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                          </div>
                        </div>

                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="" />
                          <label for="email">E-mail</label>
                        </div>
                        <div class="input-group input-group-merge">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="phoneNumber" name="contact" value="<?php echo $contact; ?>" class="form-control" placeholder="202 555 0111" />
                            <label for="phoneNumber">Phone Number</label>
                          </div>
                          <span class="input-group-text">IND (+91)</span>
                        </div>

                        <div class="form-floating form-floating-outline mb-4 mt-4">
                          <input class="form-control" value="<?php echo $dob; ?>" name="dob" type="date" id="html5-date-input" required />
                          <label for="html5-datetime-local-input">Datetime</label>
                        </div>

                      </div>
                      <div class="mt-4">
                        <button type="submit" name="btn_submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                      </div>
                    </form>
                  </div>
                  <!-- /Account -->
                </div>
                <div class="card">
                  <h5 class="card-header fw-normal">Delete Account</h5>
                  <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                      <div class="alert alert-warning">
                        <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                        <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                      </div>
                    </div>
                    <form id="formAccountDeactivation" method="post" class="needs-validation" novalidate>
                      <div class="form-check mb-3 ms-3">
                        <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" required />
                        <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                        <div class="invalid-feedback">First Select the checkbox to Deactivate Your Account</div>
                      </div>
                      <button type="submit" name="btn_delete" class="btn btn-danger">Deactivate Account</button>
                    </form>
                  </div>
                </div>
              </div>
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

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../assets/js/pages-account-settings-account.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script>
    (function() {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
</body>

</html>