<?php
// Start the session early
session_name('vendor_session');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'database_config.php'; // Include your database connection file
// Check connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if vendor_id exists in session
if (!isset($_SESSION['vendor_id'])) {
    echo "<script>alert('User not logged in.');</script>";
    header('Location: Vendor.php');
    exit();
}

$vendor_id = $_SESSION['vendor_id']; // Assign vendor_id from session

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Process the form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $email_add = $_POST['email_add'];
    $username = $_POST['username'];
    $today = date('Y-m-d');
    $targetDir = "datas/" . $username . "/" . $today . "/";

    // Ensure the target directory exists
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = "Error creating directory: $targetDir";
            header('Location: Vendor.php');
            exit();
        }
    }

    // Validate and handle file uploads
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
$fileErrors = [];
function validate_and_handle_file($fileKey, $targetDir, $allowedTypes) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        // Check if the file type is allowed
        if (!in_array($_FILES[$fileKey]['type'], $allowedTypes)) {
            // Send an alert if the file type is invalid
            echo "<script>alert('Invalid file type for $fileKey.'); window.location.href = 'Vendor.php';</script>";
            exit; // Stop further execution
        }

        // Define the target file path
        $targetFile = $targetDir . basename($_FILES[$fileKey]["name"]);
        
        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $targetFile)) {
            return $targetFile; // Return the target file path if successful
        } else {
            // Send an alert if there's an error moving the file
            echo "<script>alert('Error moving $fileKey file to destination.'); window.location.href = 'Vendor.php';</script>";
            exit; // Stop further execution
        }
    } else {
        // Optionally handle cases where no file was uploaded
        return null; // Return null if the file isn't uploaded
    }
}


$leaseAgreementsDest = validate_and_handle_file('lease_agreements', $targetDir, $allowedTypes, $fileErrors);
$businessPermitsDest = validate_and_handle_file('business_permits', $targetDir, $allowedTypes, $fileErrors);
$businessLicensesDest = validate_and_handle_file('business_licenses', $targetDir, $allowedTypes, $fileErrors);

// Check for errors and echo alerts
if (!empty($fileErrors)) {
    echo "<script>alert('" . implode("\\n", $fileErrors) . "'); window.location.href = 'Vendor.php';</script>";
    exit();
}

    $conn->begin_transaction();

    try {
        // Update vendor details
        $sql_vendor = "UPDATE vendors SET first_name=?, middle_name=?, last_name=?, age=?, address=?, email_add=?, contact_no=? WHERE vendor_id=?";
        $stmt_vendor = $conn->prepare($sql_vendor);
        if (!$stmt_vendor) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }

        $param_types_vendor = "sssissii";
        $stmt_vendor->bind_param($param_types_vendor, $first_name, $middle_name, $last_name, $age, $address, $email_add, $contact_number, $vendor_id);
        $stmt_vendor->execute();

    // Check if the documents exist for the vendor
$sql_check_documents = "SELECT COUNT(*) FROM documents WHERE vendor_id=?";
$stmt_check = $conn->prepare($sql_check_documents);
if (!$stmt_check) {
    throw new Exception('Error preparing statement: ' . $conn->error);
}

$stmt_check->bind_param("i", $vendor_id);
$stmt_check->execute();
$stmt_check->bind_result($count);
$stmt_check->fetch();
$stmt_check->close();

// Prepare the SQL statements outside of the conditional to avoid repetition
$sql_documents_update = "UPDATE documents SET lease_agreements=?, business_permits=?, business_license=? WHERE vendor_id=?";
$sql_documents_insert = "INSERT INTO documents (vendor_id, lease_agreements, business_permits, business_license) VALUES (?, ?, ?, ?)";

// Prepare the update statement
$stmt_documents_update = $conn->prepare($sql_documents_update);
if (!$stmt_documents_update) {
    throw new Exception('Error preparing update statement: ' . $conn->error);
}

// Prepare the insert statement
$stmt_documents_insert = $conn->prepare($sql_documents_insert);
if (!$stmt_documents_insert) {
    throw new Exception('Error preparing insert statement: ' . $conn->error);
}

// Bind parameters based on whether each document is uploaded or not
if ($count > 0) {
    // Update existing documents
    $stmt_documents_update->bind_param("sssi", $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest, $vendor_id);
    $stmt_documents_update->execute();
} else {
    // Insert new documents, using null for any optional fields that aren't uploaded
    $leaseAgreementsDest = isset($_FILES['lease_agreements']) ? $leaseAgreementsDest : null;
    $businessPermitsDest = isset($_FILES['business_permits']) ? $businessPermitsDest : null;
    $businessLicensesDest = isset($_FILES['business_licenses']) ? $businessLicensesDest : null;

    $stmt_documents_insert->bind_param("isss", $vendor_id, $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest);
    $stmt_documents_insert->execute();
}

// Clean up
$stmt_documents_update->close();
$stmt_documents_insert->close();



        $conn->commit();
        // Success response
        echo "<script>alert('Vendor information updated successfully!'); window.location.href = 'Vendor.php';</script>";
        exit(); // Exit after echoing script

    } catch (Exception $e) {
        $conn->rollback();
        // Error response
        echo "<script>alert('An error occurred: " . addslashes($e->getMessage()) . "'); window.location.href = 'Vendor.php';</script>";
        exit(); // Exit after echoing script
    }
}
?>
