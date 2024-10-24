<?php 
session_start(); // Start the session

include('database_config.php'); // Include database connection

date_default_timezone_set('Asia/Manila');

// Check connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendor_id = htmlspecialchars($_POST['vendor_id']); // Correct vendor_id
    $vendor_name = htmlspecialchars($_POST['vendor_name']); // Sanitize vendor_name

    echo '<script>console.log("Vendor ID: ' . $vendor_id . '");</script>'; // Debugging

    // Directory setup
    $today = date('Y-m-d');
    $targetDir = "datas/" . $vendor_id . "/" . $today . "/"; // Use vendor_id for directory naming

    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            echo "<script>alert('Error creating directory: $targetDir'); window.location.href = 'Vendor.php';</script>";
            exit();
        }
    }

    // Function to handle file upload
    function validate_and_handle_file($fileKey, $targetDir) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            if (in_array($_FILES[$fileKey]['type'], $allowedTypes)) {
                $targetFile = $targetDir . basename($_FILES[$fileKey]["name"]);
                if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $targetFile)) {
                    return $targetFile; // Return file path on success
                } else {
                    echo "<script>alert('Error moving $fileKey file.'); window.location.href = 'Vendor.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Invalid file type for $fileKey.'); window.location.href = 'Vendor.php';</script>";
                exit();
            }
        }
        return null; // No file uploaded
    }

    // Upload files
    $leaseAgreementsDest = validate_and_handle_file('lease_agreements', $targetDir);
    $businessPermitsDest = validate_and_handle_file('business_permits', $targetDir);
    $businessLicensesDest = validate_and_handle_file('business_licenses', $targetDir);

    // Check if vendor has existing documents
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

    // Update or insert document data
    if ($count > 0) {
        $updateFields = [];
        $params = [];
        $types = '';

        if ($leaseAgreementsDest !== null) {
            $updateFields[] = "lease_agreements=?";
            $params[] = $leaseAgreementsDest;
            $types .= 's';
        }
        if ($businessPermitsDest !== null) {
            $updateFields[] = "business_permits=?";
            $params[] = $businessPermitsDest;
            $types .= 's';
        }
        if ($businessLicensesDest !== null) {
            $updateFields[] = "business_license=?";
            $params[] = $businessLicensesDest;
            $types .= 's';
        }

        if (count($updateFields) > 0) {
            $sql_documents_update = "UPDATE documents SET " . implode(', ', $updateFields) . " WHERE vendor_id=?";
            $stmt_documents_update = $conn->prepare($sql_documents_update);
            if (!$stmt_documents_update) {
                throw new Exception('Error preparing update statement: ' . $conn->error);
            }

            // Add vendor_id to parameters
            $params[] = $vendor_id;
            $types .= 'i'; // Add type for vendor_id

            // Bind parameters dynamically
            $stmt_documents_update->bind_param($types, ...$params);

            if (!$stmt_documents_update->execute()) {
                echo "Update Error: " . $stmt_documents_update->error;
            }
            $stmt_documents_update->close();
        }
    } else {
        $sql_documents_insert = "INSERT INTO documents (vendor_id, lease_agreements, business_permits, business_license) VALUES (?, ?, ?, ?)";
        $stmt_documents_insert = $conn->prepare($sql_documents_insert);
        if (!$stmt_documents_insert) {
            throw new Exception('Error preparing insert statement: ' . $conn->error);
        }
        $stmt_documents_insert->bind_param("isss", $vendor_id, $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest);
        if (!$stmt_documents_insert->execute()) {
            echo "Insert Error: " . $stmt_documents_insert->error;
        }
        $stmt_documents_insert->close();
    }

    // Prepare notification message based on uploaded documents
    $uploadedDocuments = [];
    if ($leaseAgreementsDest !== null) {
        $uploadedDocuments[] = "Lease Agreements";
    }
    if ($businessPermitsDest !== null) {
        $uploadedDocuments[] = "Business Permits";
    }
    if ($businessLicensesDest !== null) {
        $uploadedDocuments[] = "Business Licenses";
    }

    // Create a descriptive message for the notification
    $documentList = implode(", ", $uploadedDocuments);
    $notification_message = "$vendor_name has uploaded the following documents: $documentList.";

    // Insert notification for admin
    $notification_type = 'New Document Upload';
    $time_stamp = date('Y-m-d H:i:s');
    $is_read = 0;

    $stmt_admin_notification = $conn->prepare("INSERT INTO notifications (user_type, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");
    $user_type_admin = 'Document Handler';

    if ($stmt_admin_notification) {
        $stmt_admin_notification->bind_param("ssssi", $user_type_admin, $notification_type, $notification_message, $time_stamp, $is_read);
        $stmt_admin_notification->execute();
        $stmt_admin_notification->close();
    }

    echo "<script>alert('Documents uploaded successfully!'); window.location.href = 'Vendor.php';</script>";
    exit();
}
?>
