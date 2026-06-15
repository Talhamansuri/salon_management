<?php

$alert = false;
$alert_message = "";

if (isset($_POST['btn_submit'])) {
    $fnames = $_POST['fname'] ?? [];
    $lnames = $_POST['lname'] ?? [];
    $genders = $_POST['gender'] ?? [];
    $dobs = $_POST['dob'] ?? [];
    $emails = $_POST['email'] ?? [];
    $passwords = $_POST['password'] ?? [];
    $contacts = $_POST['contact'] ?? [];
    $files = $_FILES['file_img'] ?? null;

    $connection = mysqli_connect("localhost", "root", "", "projectdb");
    
    $success_count = 0;
    $failed_count = 0;

    for ($i = 0; $i < count($fnames); $i++) {
        if (empty($fnames[$i])) {
            continue;
        }

        $folder = "images/customer/default.jpg";
        if (isset($files['name'][$i]) && !empty($files['name'][$i])) {
            $filename = $files['name'][$i];
            $temp = $files['tmp_name'][$i];
            $folder = "images/customer/" . time() . "_" . $filename;
            
            if (!move_uploaded_file($temp, $folder)) {
                $folder = "images/customer/default.jpg";
            }
        }

        $fname = mysqli_real_escape_string($connection, $fnames[$i]);
        $lname = mysqli_real_escape_string($connection, $lnames[$i]);
        $gender = mysqli_real_escape_string($connection, $genders[$i]);
        $dob = mysqli_real_escape_string($connection, $dobs[$i]);
        $email = mysqli_real_escape_string($connection, $emails[$i]);
        $password = mysqli_real_escape_string($connection, $passwords[$i]);
        $contact = mysqli_real_escape_string($connection, $contacts[$i]);

        $query = mysqli_query($connection, "INSERT INTO `tbl_customer` (`customer_id`, `first_name`, `last_name`, `gender`, `DOB`, `cust_img`, `contact`, `email`, `password`) VALUES (NULL, '$fname', '$lname', '$gender', '$dob', '$folder', '$contact', '$email', '$password')");
        
        if ($query) {
            $success_count++;
        } else {
            $failed_count++;
        }
    }

    if ($success_count > 0) {
        $alert = true;
        $alert_message = "$success_count customer(s) added successfully!";
        if ($failed_count > 0) {
            $alert_message .= " ($failed_count failed)";
        }
    } elseif ($failed_count > 0) {
        echo "<script>alert('Failed to add customers!');</script>";
    }
    
    mysqli_close($connection);
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Customer Form</title>

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
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Customers /</span> Customer Form</h4>

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
                                        <h5 class="mb-0">Add Customer</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="frm1" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                            
                                            <!-- Table for Multiple Entries -->
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered" id="customerTable" style="border: 2px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                                                    <thead>
                                                        <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                                            <th style="text-align: center; padding: 12px; color: white;">#</th>
                                                            <th style="padding: 12px; color: white;">First Name</th>
                                                            <th style="padding: 12px; color: white;">Last Name</th>
                                                            <th style="padding: 12px; color: white;">Gender</th>
                                                            <th style="padding: 12px; color: white;">Date of Birth</th>
                                                            <th style="padding: 12px; color: white;">Email</th>
                                                            <th style="padding: 12px; color: white;">Password</th>
                                                            <th style="padding: 12px; color: white;">Contact (10 digit)</th>
                                                            <th style="padding: 12px; color: white;">Image</th>
                                                            <th style="text-align: center; padding: 12px; color: white;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        <tr class="customer-row" style="background-color: #f8f9fa;">
                                                            <td class="row-number" style="text-align: center; font-weight: bold; background-color: #e9ecef;">1</td>
                                                            <td><input type="text" name="fname[]" class="form-control form-control-sm" placeholder="First Name" pattern="[a-zA-Z\s]+" required /></td>
                                                            <td><input type="text" name="lname[]" class="form-control form-control-sm" placeholder="Last Name" pattern="[a-zA-Z\s]+" required /></td>
                                                            <td>
                                                                <select name="gender[]" class="form-select form-select-sm" required>
                                                                    <option value="">Select</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="date" name="dob[]" class="form-control form-control-sm" required /></td>
                                                            <td>
                                                                <input type="email" name="email[]" class="form-control form-control-sm email-input" placeholder="Email" required />
                                                                <small class="text-danger email-error d-none">Invalid email format</small>
                                                            </td>
                                                            <td>
                                                                <input type="password" name="password[]" class="form-control form-control-sm password-input" placeholder="Min 6 chars, 1 uppercase" required />
                                                                <small class="text-danger password-error d-none">Min 6 chars, 1 uppercase, 1 number</small>
                                                            </td>
                                                            <td>
                                                                <input type="tel" name="contact[]" class="form-control form-control-sm contact-input" placeholder="10-digit" pattern="[0-9]{10}" maxlength="10" required />
                                                                <small class="text-danger contact-error d-none">Must be 10 digits</small>
                                                            </td>
                                                            <td><input type="file" name="file_img[]" class="form-control form-control-sm" accept="image/*" /></td>
                                                            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeCustomerRow(this)"><i class="mdi mdi-delete"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Add Row Button & Submit -->
                                            <div class="d-flex gap-2 mt-4">
                                                <button type="button" class="btn btn-info" onclick="addCustomerRow()">
                                                    <i class="mdi mdi-plus-circle"></i> Add Customer
                                                </button>
                                                <button type="submit" name="btn_submit" class="btn btn-success">
                                                    <i class="mdi mdi-check-circle"></i> Submit All Customers
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

    <!-- Validation & Multiple Entry Script -->
    <script>
        // Validation Functions
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePassword(password) {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{6,}$/;
            return passwordRegex.test(password);
        }

        function validateContact(contact) {
            const contactRegex = /^[0-9]{10}$/;
            return contactRegex.test(contact);
        }

        // Real-time validation
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

        // Form submission validation
        document.getElementById('frm1').addEventListener('submit', function(e) {
            let isValid = true;
            const rows = document.querySelectorAll('.customer-row');
            
            rows.forEach((row) => {
                const fname = row.querySelector('input[name="fname[]"]').value;
                const lname = row.querySelector('input[name="lname[]"]').value;
                const gender = row.querySelector('select[name="gender[]"]').value;
                const dob = row.querySelector('input[name="dob[]"]').value;
                const email = row.querySelector('input[name="email[]"]').value;
                const password = row.querySelector('input[name="password[]"]').value;
                const contact = row.querySelector('input[name="contact[]"]').value;

                if (!fname.trim()) {
                    alert('Please enter First Name');
                    isValid = false;
                    return;
                }
                if (!lname.trim()) {
                    alert('Please enter Last Name');
                    isValid = false;
                    return;
                }
                if (!gender) {
                    alert('Please select Gender');
                    isValid = false;
                    return;
                }
                if (!dob) {
                    alert('Please select Date of Birth');
                    isValid = false;
                    return;
                }
                if (!validateEmail(email)) {
                    alert('Invalid Email: ' + email);
                    isValid = false;
                    return;
                }
                if (!validatePassword(password)) {
                    alert('Password must be minimum 6 characters with 1 uppercase letter and 1 number');
                    isValid = false;
                    return;
                }
                if (!validateContact(contact)) {
                    alert('Contact must be 10 digits');
                    isValid = false;
                    return;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });

        function addCustomerRow() {
            const tableBody = document.getElementById('tableBody');
            const rowCount = tableBody.querySelectorAll('.customer-row').length + 1;
            
            const newRow = document.createElement('tr');
            newRow.className = 'customer-row';
            newRow.style.backgroundColor = '#f8f9fa';
            newRow.innerHTML = `
                <td class="row-number" style="text-align: center; font-weight: bold; background-color: #e9ecef;">${rowCount}</td>
                <td><input type="text" name="fname[]" class="form-control form-control-sm" placeholder="First Name" pattern="[a-zA-Z\s]+" required /></td>
                <td><input type="text" name="lname[]" class="form-control form-control-sm" placeholder="Last Name" pattern="[a-zA-Z\s]+" required /></td>
                <td>
                    <select name="gender[]" class="form-select form-select-sm" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="date" name="dob[]" class="form-control form-control-sm" required /></td>
                <td>
                    <input type="email" name="email[]" class="form-control form-control-sm email-input" placeholder="Email" required />
                    <small class="text-danger email-error d-none">Invalid email format</small>
                </td>
                <td>
                    <input type="password" name="password[]" class="form-control form-control-sm password-input" placeholder="Min 6 chars, 1 uppercase" required />
                    <small class="text-danger password-error d-none">Min 6 chars, 1 uppercase, 1 number</small>
                </td>
                <td>
                    <input type="tel" name="contact[]" class="form-control form-control-sm contact-input" placeholder="10-digit" pattern="[0-9]{10}" maxlength="10" required />
                    <small class="text-danger contact-error d-none">Must be 10 digits</small>
                </td>
                <td><input type="file" name="file_img[]" class="form-control form-control-sm" accept="image/*" /></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="removeCustomerRow(this)"><i class="mdi mdi-delete"></i></button></td>
            `;
            tableBody.appendChild(newRow);
            updateRowNumbers();
        }

        function removeCustomerRow(button) {
            const row = button.parentNode.parentNode;
            const tableBody = document.getElementById('tableBody');
            
            if (tableBody.querySelectorAll('.customer-row').length > 1) {
                row.remove();
                updateRowNumbers();
            } else {
                alert('At least one customer is required!');
            }
        }

        function updateRowNumbers() {
            const rows = document.querySelectorAll('.customer-row');
            rows.forEach((row, index) => {
                row.querySelector('.row-number').textContent = index + 1;
            });
        }
    </script>

    <!-- Custom Styles -->
    <style>
        .form-control.border-danger,
        .form-select.border-danger {
            border-color: #dc3545 !important;
            background-color: #fff5f5;
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

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }

            .form-control-sm,
            .form-select-sm {
                padding: 0.25rem 0.4rem;
                font-size: 0.75rem;
            }
        }
    </style>

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