<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "projectdb");

$cid = 5; // Example customer ID

// Fetch customer details
$customer_query = mysqli_query($connection, "SELECT * FROM tbl_customer WHERE customer_id=$cid");
$customer_data = mysqli_fetch_array($customer_query);

// Fetch upcoming appointments
$upcoming_appointments_query = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE customer_id=$cid AND appointment_date > NOW() ORDER BY appointment_date ASC");

// Fetch past appointments
$past_appointments_query = mysqli_query($connection, "SELECT * FROM tbl_appointment WHERE customer_id=$cid AND appointment_date <= NOW() ORDER BY appointment_date DESC");

// Update customer profile
if (isset($_POST['btn_updateProfile'])) {
    // Your update profile logic
}

// Update customer password
if (isset($_POST['btn_changePassword'])) {
    // Your change password logic
}

// Cancel order
if (isset($_POST['btn_cancelOrder'])) {
    // Your cancel order logic
}

// Cancel appointment
if (isset($_POST['btn_cancelAppointment'])) {
    // Your cancel appointment logic
}

?>

<!-- HTML and PHP mixed for displaying customer information, upcoming, and past appointments -->
<html>
<head>
    <title>Customer Profile</title>
</head>
<body>
    <h1>Customer Profile</h1>
    <h2>Customer Information</h2>
    <!-- Display customer information here -->
    <p>Name: <?php echo $customer_data['first_name'] . ' ' . $customer_data['last_name']; ?></p>
    <p>Email: <?php echo $customer_data['email']; ?></p>
    <!-- Update profile form -->
    <!-- Your update profile form here -->
    <h2>Upcoming Appointments</h2>
    <!-- Display upcoming appointments -->
    <?php if (mysqli_num_rows($upcoming_appointments_query) > 0) { ?>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($upcoming_appointments_query)) { ?>
                <li><?php echo $row['appointment_date']; ?> - <?php echo $row['appointment_description']; ?></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No upcoming appointments.</p>
    <?php } ?>

    <h2>Past Appointments</h2>
    <!-- Display past appointments -->
    <?php if (mysqli_num_rows($past_appointments_query) > 0) { ?>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($past_appointments_query)) { ?>
                <li><?php echo $row['appointment_date']; ?> - <?php echo $row['appointment_description']; ?></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No past appointments.</p>
    <?php } ?>
</body>
</html>
