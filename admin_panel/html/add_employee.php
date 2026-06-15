<?php
$alert = false;
$alert_message = "";

if (isset($_POST['btn_submit'])) {
 require 'connection.php';
  
  $fnames = $_POST['fname'] ?? [];
  $lnames = $_POST['lname'] ?? [];
  $genders = $_POST['gender'] ?? [];
  $emails = $_POST['email'] ?? [];
  $passwords = $_POST['password'] ?? [];
  $contacts = $_POST['contact'] ?? [];
  $addresses = $_POST['address'] ?? [];
  $designations = $_POST['designation'] ?? [];
  $salaries = $_POST['salary'] ?? [];
  $files = $_FILES['file_img'] ?? null;

  $success_count = 0;
  $failed_count = 0;

  // Process each employee entry
  for ($i = 0; $i < count($fnames); $i++) {
    // Skip empty entries
    if (empty($fnames[$i])) {
      continue;
    }

    // Handle file upload
    $folder = "images/employees/default.jpg";
    if (isset($files['name'][$i]) && !empty($files['name'][$i])) {
      $filename = $files['name'][$i];
      $temp = $files['tmp_name'][$i];
      $folder = "images/employees/" . time() . "_" . $filename;
      
      if (!move_uploaded_file($temp, $folder)) {
        $folder = "images/employees/default.jpg";
      }
    }

    $fname = mysqli_real_escape_string($connection, $fnames[$i]);
    $lname = mysqli_real_escape_string($connection, $lnames[$i]);
    $gender = mysqli_real_escape_string($connection, $genders[$i]);
    $email = mysqli_real_escape_string($connection, $emails[$i]);
    $password = mysqli_real_escape_string($connection, $passwords[$i]);
    $contact = mysqli_real_escape_string($connection, $contacts[$i]);
    $address = mysqli_real_escape_string($connection, $addresses[$i]);
    $designation = mysqli_real_escape_string($connection, $designations[$i]);
    $salary = mysqli_real_escape_string($connection, $salaries[$i]);

    $query = mysqli_query($connection, "INSERT INTO `tbl_employee` (`emp_id`, `fname`, `lname`, `gender`, `email`, `password`, `contact`, `employee_img`, `address`, `designation`, `salary`) VALUES (NULL, '$fname', '$lname', '$gender', '$email', '$password', '$contact', '$folder', '$address', '$designation', '$salary')");
    
    if ($query) {
      $success_count++;
    } else {
      $failed_count++;
    }
  }

  if ($success_count > 0) {
    $alert = true;
    $alert_message = "$success_count employee(s) added successfully!";
    if ($failed_count > 0) {
      $alert_message .= " ($failed_count failed)";
    }
  } else if ($failed_count > 0) {
    echo "<script>alert('Failed to add employees!');</script>";
  }
  
  mysqli_close($connection);
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

  <!-- Custom Validation Styles -->
  <style>
    .form-control.border-danger,
    .form-select.border-danger {
      border-color: #dc3545 !important;
      background-color: #fff5f5;
    }

    .form-control:focus.border-danger,
    .form-select:focus.border-danger {
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .email-error,
    .password-error,
    .contact-error {
      display: block;
      font-size: 0.75rem;
      margin-top: 2px;
    }

    .form-control-sm,
    .form-select-sm {
      padding: 0.375rem 0.5rem;
      font-size: 0.875rem;
    }

    .table-hover tbody tr:hover {
      background-color: #e7f3ff !important;
      transition: background-color 0.3s ease;
    }

    .table tbody td {
      vertical-align: middle;
      padding: 8px;
    }

    .btn {
      border-radius: 5px;
      padding: 0.5rem 1.5rem;
      font-weight: 500;
    }

    .card {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      border: none;
      border-radius: 10px;
    }

    .card-header {
      background-color: #f8f9fa;
      border-bottom: 2px solid #e0e0e0;
      border-radius: 10px 10px 0 0;
    }

    @media (max-width: 768px) {
      .table-responsive {
        font-size: 0.85rem;
      }

      .form-control-sm,
      .form-select-sm {
        padding: 0.25rem 0.4rem;
        font-size: 0.75rem;
      }

      .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.65rem;
      }
    }
  </style>
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
                                  " . $alert_message . " — check it out!
                          </div></div>";
                  }

                  ?>
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Employees</h5>
                  </div>
                  <div class="card-body">
                    <form id="frm1" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                      
                      <!-- Table for Multiple Entries -->
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="employeeTable" style="border: 2px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                          <thead>
                            <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                              <th style="text-align: center; padding: 12px; color: white;">#</th>
                              <th style="padding: 12px; color: white;">First Name</th>
                              <th style="padding: 12px; color: white;">Last Name</th>
                              <th style="padding: 12px; color: white;">Gender</th>
                              <th style="padding: 12px; color: white;">Email</th>
                              <th style="padding: 12px; color: white;">Password</th>
                              <th style="padding: 12px; color: white;">Contact (10 digit)</th>
                              <th style="padding: 12px; color: white;">Image</th>
                              <th style="padding: 12px; color: white;">Address</th>
                              <th style="padding: 12px; color: white;">Designation</th>
                              <th style="padding: 12px; color: white;">Salary</th>
                              <th style="text-align: center; padding: 12px; color: white;">Action</th>
                            </tr>
                          </thead>
                          <tbody id="tableBody">
                            <tr class="employee-row" style="background-color: #f8f9fa;">
                              <td class="row-number" style="text-align: center; font-weight: bold; background-color: #e9ecef;">1</td>
                              <td><input type="text" name="fname[]" class="form-control form-control-sm border-success" placeholder="John" pattern="[a-zA-Z\s]+" required /></td>
                              <td><input type="text" name="lname[]" class="form-control form-control-sm border-success" placeholder="Doe" pattern="[a-zA-Z\s]+" required /></td>
                              <td>
                                <select name="gender[]" class="form-select form-select-sm" required>
                                  <option value="">Select</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                </select>
                              </td>
                              <td>
                                <input type="email" name="email[]" class="form-control form-control-sm email-input" placeholder="name@example.com" required />
                                <small class="text-danger email-error d-none">Invalid email format</small>
                              </td>
                              <td>
                                <input type="password" name="password[]" class="form-control form-control-sm password-input" placeholder="Min 6 chars, 1 uppercase" required />
                                <small class="text-danger password-error d-none">Min 6 chars, 1 uppercase, 1 number</small>
                              </td>
                              <td>
                                <input type="tel" name="contact[]" class="form-control form-control-sm contact-input" placeholder="10-digit number" pattern="[0-9]{10}" maxlength="10" required />
                                <small class="text-danger contact-error d-none">Must be 10 digits</small>
                              </td>
                              <td><input type="file" name="file_img[]" class="form-control form-control-sm" accept="image/*" /></td>
                              <td><input type="text" name="address[]" class="form-control form-control-sm" placeholder="Address" required /></td>
                              <td>
                                <select name="designation[]" class="form-select form-select-sm" required>
                                  <option value="">Select</option>
                                  <option value="Manager">Manager</option>
                                  <option value="Sales man">Sales man</option>
                                  <option value="Employee">Employee</option>
                                  <option value="Clerk">Clerk</option>
                                </select>
                              </td>
                              <td><input type="number" name="salary[]" class="form-control form-control-sm" placeholder="12000" min="0" required /></td>
                              <td><button type="button" class="btn btn-sm btn-danger" onclick="removeEmployeeRow(this)"><i class="mdi mdi-delete"></i></button></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <!-- Add Row Button & Submit -->
                      <div class="d-flex gap-2 mt-4">
                        <button type="button" class="btn btn-info" onclick="addEmployeeRow()">
                          <i class="mdi mdi-plus-circle"></i> Add Employee
                        </button>
                        <button type="submit" name="btn_submit" class="btn btn-success">
                          <i class="mdi mdi-check-circle"></i> Submit All Employees
                        </button>
                      </div>
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
  
  <!-- Multiple Employee Entry Script -->
  <script>
    // Validation Functions
    function validateEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    function validatePassword(password) {
      // Min 6 characters, at least 1 uppercase, 1 lowercase, 1 number
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{6,}$/;
      return passwordRegex.test(password);
    }

    function validateContact(contact) {
      // Exactly 10 digits, no other characters
      const contactRegex = /^[0-9]{10}$/;
      return contactRegex.test(contact);
    }

    function validateFullName(name) {
      // Only letters and spaces
      const nameRegex = /^[a-zA-Z\s]+$/;
      return name.trim().length > 0 && nameRegex.test(name);
    }

    // Add real-time validation to all input fields
    document.addEventListener('input', function(e) {
      if (e.target.classList.contains('email-input')) {
        const row = e.target.closest('tr');
        const errorMsg = row.querySelector('.email-error');
        if (!validateEmail(e.target.value) && e.target.value !== '') {
          e.target.classList.add('border-danger');
          errorMsg.classList.remove('d-none');
        } else {
          e.target.classList.remove('border-danger');
          errorMsg.classList.add('d-none');
        }
      }

      if (e.target.classList.contains('password-input')) {
        const row = e.target.closest('tr');
        const errorMsg = row.querySelector('.password-error');
        if (!validatePassword(e.target.value) && e.target.value !== '') {
          e.target.classList.add('border-danger');
          errorMsg.classList.remove('d-none');
        } else {
          e.target.classList.remove('border-danger');
          errorMsg.classList.add('d-none');
        }
      }

      if (e.target.classList.contains('contact-input')) {
        const row = e.target.closest('tr');
        const errorMsg = row.querySelector('.contact-error');
        // Allow only numbers
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
        if (!validateContact(e.target.value) && e.target.value !== '') {
          e.target.classList.add('border-danger');
          errorMsg.classList.remove('d-none');
        } else {
          e.target.classList.remove('border-danger');
          errorMsg.classList.add('d-none');
        }
      }
    });

    // Validate entire form before submission
    document.getElementById('frm1').addEventListener('submit', function(e) {
      let isValid = true;
      const rows = document.querySelectorAll('.employee-row');
      
      rows.forEach((row) => {
        const fname = row.querySelector('input[name="fname[]"]').value;
        const lname = row.querySelector('input[name="lname[]"]').value;
        const email = row.querySelector('input[name="email[]"]').value;
        const password = row.querySelector('input[name="password[]"]').value;
        const contact = row.querySelector('input[name="contact[]"]').value;
        const gender = row.querySelector('select[name="gender[]"]').value;
        const designation = row.querySelector('select[name="designation[]"]').value;
        const address = row.querySelector('input[name="address[]"]').value;
        const salary = row.querySelector('input[name="salary[]"]').value;

        // Validation checks
        if (!validateFullName(fname)) {
          alert('First Name must contain only letters');
          isValid = false;
          return;
        }
        if (!validateFullName(lname)) {
          alert('Last Name must contain only letters');
          isValid = false;
          return;
        }
        if (!validateEmail(email)) {
          alert('Invalid Email format: ' + email);
          isValid = false;
          return;
        }
        if (!validatePassword(password)) {
          alert('Password must be minimum 6 characters with 1 uppercase letter and 1 number');
          isValid = false;
          return;
        }
        if (!validateContact(contact)) {
          alert('Contact must be exactly 10 digits');
          isValid = false;
          return;
        }
        if (!gender) {
          alert('Please select Gender');
          isValid = false;
          return;
        }
        if (!designation) {
          alert('Please select Designation');
          isValid = false;
          return;
        }
        if (!address.trim()) {
          alert('Please enter Address');
          isValid = false;
          return;
        }
        if (!salary) {
          alert('Please enter Salary');
          isValid = false;
          return;
        }
      });

      if (!isValid) {
        e.preventDefault();
      }
    });

    function addEmployeeRow() {
      const tableBody = document.getElementById('tableBody');
      const rowCount = tableBody.querySelectorAll('.employee-row').length + 1;
      
      const newRow = document.createElement('tr');
      newRow.className = 'employee-row';
      newRow.style.backgroundColor = '#f8f9fa';
      newRow.innerHTML = `
        <td class="row-number" style="text-align: center; font-weight: bold; background-color: #e9ecef;">${rowCount}</td>
        <td><input type="text" name="fname[]" class="form-control form-control-sm border-success" placeholder="John" pattern="[a-zA-Z\s]+" required /></td>
        <td><input type="text" name="lname[]" class="form-control form-control-sm border-success" placeholder="Doe" pattern="[a-zA-Z\s]+" required /></td>
        <td>
          <select name="gender[]" class="form-select form-select-sm" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </td>
        <td>
          <input type="email" name="email[]" class="form-control form-control-sm email-input" placeholder="name@example.com" required />
          <small class="text-danger email-error d-none">Invalid email format</small>
        </td>
        <td>
          <input type="password" name="password[]" class="form-control form-control-sm password-input" placeholder="Min 6 chars, 1 uppercase" required />
          <small class="text-danger password-error d-none">Min 6 chars, 1 uppercase, 1 number</small>
        </td>
        <td>
          <input type="tel" name="contact[]" class="form-control form-control-sm contact-input" placeholder="10-digit number" pattern="[0-9]{10}" maxlength="10" required />
          <small class="text-danger contact-error d-none">Must be 10 digits</small>
        </td>
        <td><input type="file" name="file_img[]" class="form-control form-control-sm" accept="image/*" /></td>
        <td><input type="text" name="address[]" class="form-control form-control-sm" placeholder="Address" required /></td>
        <td>
          <select name="designation[]" class="form-select form-select-sm" required>
            <option value="">Select</option>
            <option value="Manager">Manager</option>
            <option value="Sales man">Sales man</option>
            <option value="Employee">Employee</option>
            <option value="Clerk">Clerk</option>
          </select>
        </td>
        <td><input type="number" name="salary[]" class="form-control form-control-sm" placeholder="12000" min="0" required /></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeEmployeeRow(this)"><i class="mdi mdi-delete"></i></button></td>
      `;
      tableBody.appendChild(newRow);
      updateRowNumbers();
    }

    function removeEmployeeRow(button) {
      const row = button.parentNode.parentNode;
      const tableBody = document.getElementById('tableBody');
      
      if (tableBody.querySelectorAll('.employee-row').length > 1) {
        row.remove();
        updateRowNumbers();
      } else {
        alert('At least one employee entry is required!');
      }
    }

    function updateRowNumbers() {
      const rows = document.querySelectorAll('.employee-row');
      rows.forEach((row, index) => {
        row.querySelector('.row-number').textContent = index + 1;
      });
    }
  </script>

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