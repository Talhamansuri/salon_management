<?php
$alert = false;

if (isset($_POST['btn_submit'])) {

  $filename = $_FILES["file_img"]["name"];
  $temp = $_FILES["file_img"]["tmp_name"];
  $folder = "images/employees/" . $filename;
  move_uploaded_file($temp, $folder);
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];
  $designation = $_POST['designation'];
  $salary = $_POST['salary'];
  $connection = mysqli_connect("localhost", "root", "", "projectdb");
  $query = mysqli_query($connection, "INSERT INTO `tbl_employee` (`emp_id`, `fname`, `lname`, `gender`, `email`, `password`, `contact`, `employee_img`, `address`, `designation`, `salary`)VALUES (NULL, '$fname', '$lname', '$gender', '$email', '$password', '$contact','$folder', '$address', '$designation', '$salary')");
  if ($query) {
    $alert = true;
  } else {
    echo "<script>alert('Record added failed...!');</script>";
  }
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Employee Form</title>

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
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Employee /</span> Employee Form</h4>

            <!-- Basic Layout -->
            <div class="row">
              <!-- Merged -->
              <div class="col-xl">
                <div class="card mb-4">
                  <?php

                  if ($alert == true) {
                    echo "<div id='alert' class='card-header'><div class='alert alert-success alert-dismissible' role='alert'>
                                  Data submitted Successfully — check it out!
                          </div></div>";
                  }

                  ?>
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Employees</h5>
                  </div>
                  <div class="card-body">
                    <form id="frm1" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                      <div class="row">
                        <div class="col">
                          <div class="form-floating form-floating-outline mb-4">
                            <input type="text" name="fname" class="form-control" id="floatingInput" placeholder="John" aria-describedby="floatingInputHelp" required />
                            <label for="floatingInput">First Name</label>
                            <div class="invalid-feedback">
                              Please Enter First Name
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-floating form-floating-outline mb-4">
                            <input type="text" name="lname" class="form-control" id="floatingInput" placeholder="die" aria-describedby="floatingInputHelp" required />
                            <label for="floatingInput">Last Name</label>
                            <div class="invalid-feedback">
                              Please Enter Last Name
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md mb-3">
                        <small class="text-light fw-medium d-block">Gender</small>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Male" />
                          <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Female" required />
                          <label class="form-check-label" for="inlineRadio2">Female</label>

                        </div>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Enter Email</label>
                        <div class="invalid-feedback">
                          Please enter valid Email Address
                        </div>
                      </div>
                      <div class="mb-4">
                        <div class="form-password-toggle">
                          <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                              <input type="password" name="password" class="form-control" id="floatingInput" placeholder="********" aria-describedby="floatingInputHelp" required />
                              <label for="floatingInput">Enter Password</label>
                              <div class="invalid-feedback">
                                Please Enter your password
                              </div>
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <input type="tel" name="contact" class="form-control" id="floatingInput" placeholder="Phone number" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Enter Phone number</label>
                        <div class="invalid-feedback">
                          Please Enter Valid Phone number
                        </div>
                      </div>

                      <div class="input-group mb-4">
                        <input name="file_img" type="file" class="form-control" id="inputGroupFile02" required />
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        <div class="invalid-feedback">
                          Please Upload File.
                        </div>
                      </div>

                      <div class="form-floating form-floating-outline mb-4">
                        <textarea name="address" class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Enter your Adreess in details" required></textarea>
                        <label for="exampleFormControlTextarea1">Address</label>
                        <div class="invalid-feedback">Please enter Address </div>
                      </div>

                      <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="exampleFormControlSelect1" name="designation" aria-label="Default select example" required>
                          <option value="" selected disabled>Select Option for designation</option>
                          <option value="Manager">Manager</option>
                          <option value="Sales man">Sales man</option>
                          <option value="Employee">Employee</option>
                          <option value="Clerk">Clerk</option>
                        </select>
                        <label for="exampleFormControlSelect1">Select Designation</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-4">
                        <input type="number" name="salary" class="form-control" id="floatingInput" placeholder="ex. 12000" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Enter Salary</label>
                        <div class="invalid-feedback">
                          Please enter salary
                        </div>
                      </div>
                      <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
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
  <script>
    var alertElement = document.getElementById('alert');
    setTimeout(function() {
      alertElement.style.display = 'none';
    }, 5000);
  </script>
</body>

</html>