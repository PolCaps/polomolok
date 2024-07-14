<?php
require_once 'database_config.php'; // Include your database connection file
session_start(); // Start the session

// Collect form data
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$age = $_POST['age'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$email_add = $_POST['email_add'];
$stall_no = $_POST['stall_no'];
$building_type = $_POST['building_type'];
$monthly_rentals = $_POST['monthly_rentals'];
$building_floor = $_POST['building_floor'];
$started_date = $_POST['started_date'];
$end_date = $_POST['end_date'];
$stall_status = "Occupied"; // Added default value for stall status

// Handle file uploads
$upload_dir = 'uploads/'; // Directory to save uploaded files
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$lease_agreements_path = $upload_dir . basename($_FILES['lease_agreements']['name']);
$business_permits_path = $upload_dir . basename($_FILES['business_permits']['name']);
$business_licenses_path = $upload_dir . basename($_FILES['business_licenses']['name']);
$receipts_path = $upload_dir . basename($_FILES['receipts']['name']);

$upload_success = true;

// Move uploaded files to the directory
if (!move_uploaded_file($_FILES['lease_agreements']['tmp_name'], $lease_agreements_path)) {
    $_SESSION['alert_class'] = 'alert-danger';
    $_SESSION['alert_message'] = 'Failed to upload Lease Agreements.';
    $upload_success = false;
}
if (!move_uploaded_file($_FILES['business_permits']['tmp_name'], $business_permits_path)) {
    $_SESSION['alert_class'] = 'alert-danger';
    $_SESSION['alert_message'] = 'Failed to upload Business Permits.';
    $upload_success = false;
}
if (!move_uploaded_file($_FILES['business_licenses']['tmp_name'], $business_licenses_path)) {
    $_SESSION['alert_class'] = 'alert-danger';
    $_SESSION['alert_message'] = 'Failed to upload Business Licenses.';
    $upload_success = false;
}
if (!move_uploaded_file($_FILES['receipts']['tmp_name'], $receipts_path)) {
    $_SESSION['alert_class'] = 'alert-danger';
    $_SESSION['alert_message'] = 'Failed to upload Payment Receipts.';
    $upload_success = false;
}

// Proceed only if all uploads were successful
if ($upload_success) {
    try {
        // Insert data into the vendors table
        $sql_vendor = "INSERT INTO vendors (username, password, first_name, middle_name, last_name, age, contact_number, address, email_add, lease_agreements, business_permits, business_licenses, receipts, started_date, end_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_vendor = $pdo->prepare($sql_vendor);
        $stmt_vendor->execute([$username, $password, $first_name, $middle_name, $last_name, $age, $contact_number, $address, $email_add, $lease_agreements_path, $business_permits_path, $business_licenses_path, $receipts_path, $started_date, $end_date]);

        // Get the last inserted vendor ID
        $vendor_id = $pdo->lastInsertId();

        // Insert data into the stalls table
        $sql_stall = "INSERT INTO stalls (vendor_id, stall_no, building_type, building_floor, monthly_rentals, stall_status)
                      VALUES (?, ?, ?, ?, ?, ?)";

        $stmt_stall = $pdo->prepare($sql_stall);
        $stmt_stall->execute([$vendor_id, $stall_no, $building_type, $building_floor, $monthly_rentals, $stall_status]);

        // Success message
        $_SESSION['alert_class'] = 'alert-success';
        $_SESSION['alert_message'] = 'Vendor and Stall created successfully!';
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // 23000 is the code for a duplicate entry
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = 'Username already exists. Please choose a different username.';
        } else {
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = 'An error occurred: ' . $e->getMessage();
        }
    }
} else {
    $_SESSION['alert_class'] = 'alert-danger';
    $_SESSION['alert_message'] = 'File upload failed. Please try again.';
}

// Redirect back to the form page
header('Location: AMvendor.php');
exit();
?>