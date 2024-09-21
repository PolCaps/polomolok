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
        $due_date = $_POST['payment_due'];

        // Your SQL insert statement
        $sql_vendor = "INSERT INTO vendors (username, password, started_date, payment_due) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt_vendor = $conn->prepare($sql_vendor);
        if (!$stmt_vendor) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }

        // Bind the parameters
        $stmt_vendor->bind_param('ssss', $username, $password, $started_date, $due_date);

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
            echo "<script>alert('Error preparing statement: " . $conn->error . "'); window.location.href = 'AMvendor.php';</script>";
            exit;
        }
        $stmt_building_update->bind_param("is", $vendor_id, $stall_no);
        $stmt_building_update->execute();

        // Debugging: Check the number of affected rows
        if ($stmt_building_update->affected_rows == 0) {
            echo "<script>alert('No rows updated in the building table. Check the stall_no value.'); window.location.href = 'AMvendor.php';</script>";
            exit;
        }

        // Determine stall status based on vendor_id
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


        $conn->commit();

        // Success response
        echo "<script>alert('Vendor and Stall created successfully!'); window.location.href = 'AMvendor.php';</script>";
    } catch (Exception $e) {
        $conn->rollback();
        // Error response
        echo "<script>alert('An error occurred: " . $e->getMessage() . "'); window.location.href = 'AMvendor.php';</script>";
    }
}


if (isset($_SESSION) && array_key_exists('vendor_id', $_SESSION) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
   

    // isset database ig magbuhat account si vendor upon login

    if (isset($vendor_id) && isset($username)) {
        $_SESSION['vendor_id'] = $vendor_id;
        $_SESSION['username'] = $username;
    } else {
        echo "<script>alert('User not logged in.');</script>";
        die("Session down.");
        exit();
    }

    
     $vendor_id = $_SESSION['vendor_id'];
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

   

    // Create target directory if it doesn't exist
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = "Error creating directory: $targetDir";
            header('Location: Vendor.php');
            exit();
        }
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', '*/*'];
    $fileErrors = [];

    function validate_and_handle_file($fileKey, $targetDir, $allowedTypes, &$fileErrors) {
        if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            $fileErrors[] = "Error uploading $fileKey file.";
            return null;
        }

        if (!in_array($_FILES[$fileKey]['type'], $allowedTypes)) {
            $fileErrors[] = "Invalid file type for $fileKey.";
            return null;
        }

        $targetFile = $targetDir . basename($_FILES[$fileKey]["name"]);
        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $targetFile)) {
            return $targetFile; // Return path to the uploaded file
        } else {
            $fileErrors[] = "Error moving $fileKey file to destination.";
            return null;
        }
    }

    $leaseAgreementsDest = validate_and_handle_file('lease_agreements', $targetDir, $allowedTypes, $fileErrors);
    $businessPermitsDest = validate_and_handle_file('business_permits', $targetDir, $allowedTypes, $fileErrors);
    $businessLicensesDest = validate_and_handle_file('business_licenses', $targetDir, $allowedTypes, $fileErrors);

    if (!empty($fileErrors)) {
        $_SESSION['alert_class'] = 'alert-danger';
        $_SESSION['alert_message'] = implode("\n", $fileErrors);
        header('Location: Vendor.php');
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

if ($count > 0) {
    // Update documents
    $sql_documents = "UPDATE documents SET lease_agreements=?, business_permits=?, business_license=? WHERE vendor_id=?";
    $stmt_documents = $conn->prepare($sql_documents);
    if (!$stmt_documents) {
        throw new Exception('Error preparing statement: ' . $conn->error);
    }

    $param_types_documents = "sssi";
    $stmt_documents->bind_param($param_types_documents, $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest, $vendor_id);
    $stmt_documents->execute();
} else {
    // Insert new documents
    $sql_documents = "INSERT INTO documents (vendor_id, lease_agreements, business_permits, business_license) VALUES (?, ?, ?, ?)";
    $stmt_documents = $conn->prepare($sql_documents);
    if (!$stmt_documents) {
        throw new Exception('Error preparing statement: ' . $conn->error);
    }

    $param_types_documents = "isss";
    $stmt_documents->bind_param($param_types_documents, $vendor_id, $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest);
    $stmt_documents->execute();
}

// Continue with the rest of your transaction


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
