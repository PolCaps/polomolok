<?php

require_once 'database_config.php'; // Include your database connection file
session_start(); // Start the session

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    try {
        // Start transaction
        $conn->begin_transaction();
        // Collect form data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stall_no = $_POST['stall_no'];
        $building_type = $_POST['building_type'];
        $monthly_rentals = $_POST['monthly_rentals'];
        $building_floor = $_POST['building_floor'];
        $started_date = $_POST['started_date'];
        $end_date = $_POST['end_date'];
      //  $stall_status = "Occupied"; // Added default value for stall status

        // Your SQL insert statement
$sql_vendor = "INSERT INTO vendors (username, password, started_date, end_date) VALUES (?, ?, ?, ?)";

// Prepare the statement
$stmt_vendor = $conn->prepare($sql_vendor);
if (!$stmt_vendor) {
    throw new Exception('Error preparing statement: ' . $conn->error);
}

// Bind the parameters
$stmt_vendor->bind_param('ssss', $username, $password, $started_date, $end_date);

// Execute the statement (do not pass any arguments to execute())
if (!$stmt_vendor->execute()) {
    throw new Exception('Error executing statement: ' . $stmt_vendor->error);
}

// Get the last inserted ID
$vendor_id = $stmt_vendor->insert_id;

        // Determine building table
        switch ($building_type) {
            case 'building_a':
                $building_table = 'building_a';
                break;
            case 'building_b':
                $building_table = 'building_b';
                break;
            case 'building_c':
                $building_table = 'building_c';
                break;
            case 'building_d':
                $building_table = 'building_d';
                break;
            case 'building_e':
                $building_table = 'building_e';
                break;
            case 'building_f':
                $building_table = 'building_f';
                break;
            case 'building_g':
                $building_table = 'building_g';
                break;
            case 'building_h':
                $building_table = 'building_h';
                break;
            case 'building_i':
                $building_table = 'building_i';
                break;
            case 'building_j':
                $building_table = 'building_j';
                break;
            default:
                throw new Exception('Invalid building type.');
        }

      // Update building with vendor_id
    $sql_building_update = "UPDATE $building_table SET vendor_id = ? WHERE stall_no = ?";
    $stmt_building_update = $conn->prepare($sql_building_update);
    if (!$stmt_building_update) {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $conn->error]);
        exit;
    }
    $stmt_building_update->bind_param("is", $vendor_id, $stall_no);
    $stmt_building_update->execute();

    // Debugging: Check the number of affected rows
    if ($stmt_building_update->affected_rows == 0) {
        echo json_encode(['status' => 'error', 'message' => 'No rows updated in the building table. Check the stall_no value.']);
        exit;
    }
    
       
    //  // Determine stall status based on vendor_id
     if ($vendor_id !== null) {
        $stall_status = 'Occupied';
    } else {
        $stall_status = 'Vacant';
    }

   // Update stall status
    $sql = "UPDATE $building_type SET stall_status = ? WHERE stall_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $stall_status, $stall_no);
    $stmt->execute();

    
        // $sql_documents = "INSERT INTO documents (vendor_id, lease_agreements, business_permits, business_license)
        //                 VALUES (?, ?, ?, ?)";
        // $stmt_documents = $conn->prepare($sql_documents);
        // if (!$stmt_documents) {
        //     throw new Exception('Error preparing statement: ' . $conn->error);
        // }
        // $param_types_documents = "ibbb";
        // $stmt_documents->bind_param($param_types_documents, $vendor_id, $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest);
        // // Assuming successful preparation...
        // $stmt_documents->send_long_data(1, $leaseAgreementsDest);
        // $stmt_documents->send_long_data(2, $businessPermitsDest);
        // $stmt_documents->send_long_data(3, $businessLicensesDest);
        // $stmt_documents->execute();

        // $sql_receipts = "INSERT INTO receipts (vendor_id, receipts, issued_date)
        //                 VALUES (?, ?, ?)";
        // $stmt_receipts = $conn->prepare($sql_receipts);
        // if (!$stmt_receipts) {
        //     throw new Exception('Error preparing statement: ' . $conn->error);
        // }
        // $param_types_receipts = "ibs";
        // $stmt_receipts->bind_param($param_types_receipts, $vendor_id, $receiptsDest, $started_date);
        // $stmt_receipts->send_long_data(1, $receiptsDest);
        // $stmt_receipts->execute();
    

        $conn->commit();
        

        $_SESSION['alert_class'] = 'alert-success';
        $_SESSION['alert_message'] = 'Vendor and Stall created successfully!';
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['alert_class'] = 'alert-danger';
        $_SESSION['alert_message'] = 'An error occurred: ' . $e->getMessage();
    }

    header('Location: AMvendor.php');
    exit();
}

?>