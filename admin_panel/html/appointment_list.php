<?php
# Include the necessary files for PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$connection = mysqli_connect("localhost", "root", "", "projectdb");

if (isset($_GET['did'])) {
    mysqli_query($connection, "DELETE FROM tbl_appointment WHERE appointment_id='$_GET[did]'");
} else {
    mysqli_error($connection);
}

$query = mysqli_query($connection, "SELECT * FROM tbl_appointment JOIN tbl_service_category ON tbl_appointment.service=tbl_service_category.category_id");

# Function to send email
function sendEmail($recipient, $subject, $message) {
    try {
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

        // Send email
        $mail->send();
    } catch (Exception $e) {
        // Handle the error (log, echo, etc.)
        echo "Email could not be sent. PHPMailer Error: {$mail->ErrorInfo}";
    }
}

# Process status update for confirmed appointments
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $update_query = mysqli_query($connection, "UPDATE `tbl_appointment` SET `status`='Completed' WHERE appointment_id=$cid");

    # Get appointment details to send email
    $appointment = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE appointment_id=$cid"));

    # Send email when appointment status is confirmed
    sendEmail('furkanshaikh2138@gmail.com', 'Appointment Confirmed', "Hello {$appointment['first_name']} {$appointment['last_name']},\nYour appointment scheduled for {$appointment['appointment_date']} has been confirmed. We look forward to seeing you.");
    echo "<script>alert('Appointment status updated')</script>";
    echo "<script>window.location.href='appointment_list.php'</script>";

}

# Process status update for cancelled appointments
if (isset($_GET['rid'])) {
    $rid = $_GET['rid'];
    $update_query = mysqli_query($connection, "UPDATE `tbl_appointment` SET `status`='Cancelled' WHERE appointment_id=$rid");

    # Get appointment details to send email
    $appointment = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE appointment_id=$rid"));

    # Send email when appointment status is cancelled
    sendEmail(
        'furkanshaikh2138@gmail.com',
        'Appointment Cancelled',
        "Hello {$appointment['first_name']} {$appointment['last_name']},\nUnfortunately, your appointment scheduled for {$appointment['appointment_date']} has been cancelled. Please contact us for rescheduling."
    );
    echo "<script>alert('Appointment status updated')</script>";
    echo "<script>window.location.href='appointment_list.php'</script>";

}


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Appointment List</title>

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
    <style>
        .spinner {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #processing-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            visibility: hidden;
        }
    </style>
</head>


<body>
    <!-- Loading overlay -->
    <div id="processing-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Page Content -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include "sidebar.php"; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include "navbar.php"; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-3 mb-4">
                            <span class="text-muted fw-light">Forms /</span><span class="text-muted fw-light">Appointment /</span> Appointment List
                        </h4>

                        <hr class="my-5" />

                        <!-- Bootstrap Table with Header - Light -->
                        <div class="card">
                            <div class="table-responsive text-nowrap m-4">
                                <table class="table" id="myTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>Customer Name</th>
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
                                        while ($appointment = mysqli_fetch_array($query)) {
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
                                                        <a class='dropdown-item' href='update_appointment.php?uid={$appointment['appointment_id']}'><i class='mdi mdi-pencil-outline me-1'></i> Update </a>
                                                        <a class='dropdown-item' href='appointment_list.php?cid={$appointment['appointment_id']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                                                            <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z'/>
                                                            <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0'/>
                                                        </svg>  Accept                                                       
                                                      </a>
                                                      <a class='dropdown-item' href='appointment_list.php?did={$appointment['appointment_id']}'><i class='mdi mdi-trash-can-outline me-1'></i> Reject</a>
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
                        <!-- / Bootstrap Table with Header - Light -->

                        <hr class="my-5" />
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include "footer.php"; ?>
                    <!-- / Footer -->
                </div>
                <!-- / Content wrapper -->

                <!-- Page spinner processing -->
                <script>
                    function startProcessing() {
                        document.getElementById("processing-overlay").style.visibility = "visible";
                    }
                </script>
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>