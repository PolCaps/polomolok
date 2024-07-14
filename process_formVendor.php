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

        $leaseAgreements = $_FILES['lease_agreements'];
        $businessPermits = $_FILES['business_permits'];
        $businessLicenses = $_FILES['business_licenses'];
        $receipts = $_FILES['receipts'];


        // File upload validation
        $fileErrors = [];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', '*/*'];

        function validate_and_handle_file($fileKey, $allowedTypes, &$fileErrors) {
            if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
                $fileErrors[] = "Error uploading $fileKey file.";
                return null;
            } elseif (!in_array($_FILES[$fileKey]['type'], $allowedTypes)) {
                $fileErrors[] = "Invalid file type for $fileKey.";
                return null;
            }

            $username = $_POST['username'];
            $today = date('Y-m-d');
            $targetDir = "datas/" . $username . "/" . $today . "/";

            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0755, true)) {
                    $fileErrors[] = "Error creating directory: $targetDir";
                    return null;
                }
            }
            $targetFile = $targetDir . basename($_FILES[$fileKey]["name"]);

            if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $targetFile)) {
                return $targetFile; // Return path to the uploaded file
            } else {
                $fileErrors[] = "Error moving $fileKey file to destination.";
                return null;
            }
        }

        $upload_success = true;

        $receiptsDest = validate_and_handle_file('receipts', $allowedTypes, $fileErrors);
        $leaseAgreementsDest = validate_and_handle_file('lease_agreements', $allowedTypes, $fileErrors);
        $businessPermitsDest = validate_and_handle_file('business_permits', $allowedTypes, $fileErrors);
        $businessLicensesDest = validate_and_handle_file('business_licenses', $allowedTypes, $fileErrors);

        if (!empty($fileErrors)) {
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = implode("\n", $fileErrors);
            header('Location: AMvendor.php');
            exit();
        }
            $conn->begin_transaction();

            $sql_vendor = "INSERT INTO vendors (username, password, first_name, middle_name, last_name, age, address, email_add, contact_no, started_date, end_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_vendor = $conn->prepare($sql_vendor);
            if (!$stmt_vendor) {
                throw new Exception('Error preparing statement: ' . $conn->error);
            }
            $param_types_vendor = "sssssississ";
            $stmt_vendor->bind_param($param_types_vendor, $username, $password, $first_name, $middle_name, $last_name, $age, $address, $email_add, $contact_number, $started_date, $end_date);
            $stmt_vendor->execute();
            $vendor_id = $conn->insert_id;

            $sql_stall = "INSERT INTO stalls (stall_no, building_type, building_floor, monthly_rental, vendor_id, stall_status)
                        VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_stall = $conn->prepare($sql_stall);
            if (!$stmt_stall) {
                throw new Exception('Error preparing statement: ' . $conn->error);
            }
            $param_types_stall = "issiis";
            $stmt_stall->bind_param($param_types_stall, $stall_no, $building_type, $building_floor, $monthly_rentals, $vendor_id, $stall_status);
            $stmt_stall->execute();

            $sql_documents = "INSERT INTO documents (vendor_id, lease_agreements, business_permits, business_license)
                            VALUES (?, ?, ?, ?)";
            $stmt_documents = $conn->prepare($sql_documents);
            if (!$stmt_documents) {
                throw new Exception('Error preparing statement: ' . $conn->error);
            }
            $param_types_documents = "ibbb";
            $stmt_documents->bind_param($param_types_documents, $vendor_id, $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest);
            // Assuming successful preparation...
            $stmt_documents->send_long_data(1, $leaseAgreementsDest);
            $stmt_documents->send_long_data(2, $businessPermitsDest);
            $stmt_documents->send_long_data(3, $businessLicensesDest);
            $stmt_documents->execute();

            $sql_receipts = "INSERT INTO receipts (vendor_id, receipts, issued_date)
                            VALUES (?, ?, ?)";
            $stmt_receipts = $conn->prepare($sql_receipts);
            if (!$stmt_receipts) {
                throw new Exception('Error preparing statement: ' . $conn->error);
            }
            $param_types_receipts = "ibs";
            $stmt_receipts->bind_param($param_types_receipts, $vendor_id, $receiptsDest, $started_date);
            $stmt_receipts->send_long_data(1, $receiptsDest);
            $stmt_receipts->execute();

            $conn->commit();

            $_SESSION['alert_class'] = 'alert-success';
            $_SESSION['alert_message'] = 'Vendor and Stall created successfully!';
        }

 catch (Exception $e) {
    $conn->rollback();
    $_SESSION['alert_class'] = 'alert-danger';
    $_SESSION['alert_message'] = 'An error occurred: ' . $e->getMessage();
}

header('Location: AMvendor.php');
exit();
}

?>