<?php
require_once 'database_config.php'; // Include your database connection file

// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitV'])) {
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
        $payment_due = $_POST['payment_due']; 
        $stall_status = "Occupied";

        // Determine due date based on payment frequency
        $due_date = date('Y-m-d', strtotime($started_date)); // Initialize due_date with the started_date
        if ($payment_due === 'MONTHLY') {
            $due_date = date('Y-m-d', strtotime("+1 month", strtotime($started_date)));
            $due_status = 'Due Monthly';
        } elseif ($payment_due === 'QUARTERLY') {
            $due_date = date('Y-m-d', strtotime("+3 months", strtotime($started_date)));
            $due_status = 'Due Quarterly';
        } elseif ($payment_due === 'YEARLY') {
            $due_date = date('Y-m-d', strtotime("+1 year", strtotime($started_date)));
            $due_status = 'Due Yearly';
        }

        // Your SQL insert statement for vendors
        $sql_vendor = "INSERT INTO vendors (username, password, started_date, payment_due) 
                       VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt_vendor = $conn->prepare($sql_vendor);
        if (!$stmt_vendor) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }

        // Bind the parameters
        $stmt_vendor->bind_param('ssss', $username, $password, $started_date, $payment_due);

        // Execute the statement
        if (!$stmt_vendor->execute()) {
            throw new Exception('Error executing statement: ' . $stmt_vendor->error);
        }

        // Get the last inserted vendor ID
        $vendor_id = $stmt_vendor->insert_id;

        // Determine building table based on selected building
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

        // Update the building table with the vendor ID, and also set the necessary fields
        $sql_building_update = "UPDATE $building_table SET 
                                    vendor_id = ?, 
                                    started_date = ?, 
                                    due_date = ?, 
                                    due_status = ?, 
                                    stall_status = ? 
                                WHERE stall_no = ?";

        $stmt_building_update = $conn->prepare($sql_building_update);
        if (!$stmt_building_update) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }

        // Bind parameters (Note: vendor_id is an integer, others are strings)
        $stmt_building_update->bind_param("ssssss", $vendor_id, $started_date, $due_date, $due_status, $stall_status, $stall_no);
        if (!$stmt_building_update->execute()) {
            throw new Exception('Error executing statement: ' . $stmt_building_update->error);
        }

        // Commit the transaction
        $conn->commit();

        // Success response
        echo "<script>alert('Vendor and Stall created successfully!'); window.location.href = 'AMvendor.php';</script>";
    } catch (Exception $e) {
        $conn->rollback();
        // Error response
        echo "<script>alert('An error occurred: " . $e->getMessage() . "'); window.location.href = 'AMvendor.php';</script>";
    }
}
?>
