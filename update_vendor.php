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
        $vendor_id = $_POST['vendor_id']; // Assume you have vendor_id as a hidden input in your form
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $contact_number = $_POST['contact_number'];
        $address = $_POST['address'];
        $email_add = $_POST['email_add'];

        $leaseAgreements = isset($_FILES['lease_agreements']) ? $_FILES['lease_agreements'] : null;
        $businessPermits = isset($_FILES['business_permits']) ? $_FILES['business_permits'] : null;
        $businessLicenses = isset($_FILES['business_licenses']) ? $_FILES['business_licenses'] : null;

        $fileErrors = [];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];

        function validate_and_handle_file($file, $allowedTypes, &$fileErrors) {
            if ($file && isset($file['error']) && $file['error'] === UPLOAD_ERR_OK) {
                if (!in_array($file['type'], $allowedTypes)) {
                    $fileErrors[] = "Invalid file type for " . basename($file["name"]) . ".";
                    return null;
                }

                $first_name = $_POST['first_name'];
                $today = date('Y-m-d');
                $targetDir = "datas/" . $first_name . "/" . $today . "/";

                if (!is_dir($targetDir)) {
                    if (!mkdir($targetDir, 0755, true)) {
                        $fileErrors[] = "Error creating directory: $targetDir";
                        return null;
                    }
                }
                $targetFile = $targetDir . basename($file["name"]);

                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    return $targetFile; // Return path to the uploaded file
                } else {
                    $fileErrors[] = "Error moving " . basename($file["name"]) . " file to destination.";
                    return null;
                }
            }
            return null;
        }

        $leaseAgreementsDest = validate_and_handle_file($leaseAgreements, $allowedTypes, $fileErrors);
        $businessPermitsDest = validate_and_handle_file($businessPermits, $allowedTypes, $fileErrors);
        $businessLicensesDest = validate_and_handle_file($businessLicenses, $allowedTypes, $fileErrors);

        if (!empty($fileErrors)) {
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = implode("\n", $fileErrors);
            header('Location: Vendor.php');
            exit();
        }

        // Your SQL update statement
        $sql_vendor = "UPDATE vendors SET first_name = ?, middle_name = ?, last_name = ?, age = ?, contact_no = ?, address = ?, email_add = ? WHERE id = ?";

        // Prepare the statement
        $stmt_vendor = $conn->prepare($sql_vendor);
        if (!$stmt_vendor) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }

        // Bind the parameters
        $stmt_vendor->bind_param('sssiissi', $first_name, $middle_name, $last_name, $age, $contact_number, $address, $email_add, $vendor_id);

        // Execute the statement (do not pass any arguments to execute())
        if (!$stmt_vendor->execute()) {
            throw new Exception('Error executing statement: ' . $stmt_vendor->error);
        }

        // Update documents
        $sql_documents = "UPDATE documents SET lease_agreements = ?, business_permits = ?, business_license = ? WHERE vendor_id = ?";
        $stmt_documents = $conn->prepare($sql_documents);
        if (!$stmt_documents) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }
        $stmt_documents->bind_param('sssi', $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest, $vendor_id);
        if (!$stmt_documents->execute()) {
            throw new Exception('Error executing statement: ' . $stmt_documents->error);
        }

        $conn->commit();

        $_SESSION['alert_class'] = 'alert-success';
        $_SESSION['alert_message'] = 'Vendor updated successfully!';
        header('Location: update_vendor.php'); // Ensure this is the correct location
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['alert_class'] = 'alert-danger';
        $_SESSION['alert_message'] = 'An error occurred: ' . $e->getMessage();
        header('Location: Vendor.php'); // Ensure this is the correct location
        exit();
    }
}

?>
