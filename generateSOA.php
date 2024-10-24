<?php
header('Content-Type: application/json');
ob_start(); // Start output buffering

// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . addslashes($conn->connect_error)]);
    exit;
}
date_default_timezone_set('Asia/Manila');
// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Extract values from POST and check if they are set
    $vendorId = $_POST['vendor-id'] ?? null;
    $username = $_POST['name'] ?? null;
    $message = $_POST['reminderMessage'] ?? null;
    $otherFee = $_POST['remaining-balance'] ?? null;
    $monthlyRent = $_POST['totalPay'] ?? null;
    $totalFees = $_POST['total_fees'] ?? null;

    $pdfFile = $_FILES['pdfFile'] ?? null;

    // Check if PDF file is uploaded
    if ($pdfFile && $pdfFile['error'] === UPLOAD_ERR_OK) {
        // Get the original file name and extension
        $originalFileName = pathinfo($pdfFile['name'], PATHINFO_FILENAME);
        $fileExtension = pathinfo($pdfFile['name'], PATHINFO_EXTENSION);
        
        // Set the initial file path
        $filePath = "billing/{$pdfFile['name']}";

        // Check if the file already exists and modify the name if necessary
        $counter = 1;
        while (file_exists($filePath)) {
            // Create a new file name with an incrementing counter
            $newFileName = "{$originalFileName} ({$counter}).{$fileExtension}";
            $filePath = "billing/{$newFileName}";
            $counter++;
        }
    
        // Move the uploaded file to the specified path
        if (move_uploaded_file($pdfFile['tmp_name'], $filePath)) {
            // Validate required fields
            if (empty($vendorId) || empty($username) || empty($message) || empty($filePath)) {
                echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
                exit;
            }

            // Check if the vendor ID exists
            $sqlCheck = "SELECT id FROM vendorsoa WHERE vendor_id = ?";
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param("i", $vendorId);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();

            // Prepare notification details
            $notification_type = 'Statement of Account Update';
            $notification_message = "You have a new Statement of Account";
            $time_stamp = date('Y-m-d H:i:s'); // Current timestamp
            $is_read = 0; // Unread notification

            if ($resultCheck->num_rows > 0) {
                // Vendor ID exists, update the record
                $sqlUpdate = "UPDATE vendorsoa SET username = ?, message = ?, monthly_rentals = ?, other_fees = ?, total_amount = ?, file_path = ? WHERE vendor_id = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ssssssi", $username, $message, $monthlyRent, $otherFee, $totalFees, $filePath, $vendorId);

                if ($stmtUpdate->execute()) {
                    // Insert notification for the vendor
                    insertNotification($conn, $vendorId, $notification_type, $notification_message, $time_stamp, $is_read);

                    echo json_encode(['success' => true, 'message' => 'Statement of Account updated successfully!']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update statement in database: ' . addslashes($stmtUpdate->error)]);
                }

                $stmtUpdate->close();
            } else {
                // Vendor ID does not exist, insert a new record
                $sqlInsert = "INSERT INTO vendorsoa (vendor_id, username, message, monthly_rentals, other_fees, total_amount, file_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("issssss", $vendorId, $username, $message, $monthlyRent, $otherFee, $totalFees, $filePath);

                if ($stmtInsert->execute()) {
                    // Insert notification for the vendor
                    insertNotification($conn, $vendorId, $notification_type, $notification_message, $time_stamp, $is_read);

                    echo json_encode(['success' => true, 'message' => 'Statement of Account generated successfully!']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to insert statement into database: ' . addslashes($stmtInsert->error)]);
                }

                $stmtInsert->close();
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error saving file']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No PDF file uploaded or upload failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Function to insert notifications
function insertNotification($conn, $vendorId, $notification_type, $notification_message, $time_stamp, $is_read) {
    $stmt = $conn->prepare("INSERT INTO notifications (vendor_id, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssi", $vendorId, $notification_type, $notification_message, $time_stamp, $is_read);
        $stmt->execute();
        $stmt->close();
    }
}

ob_end_flush(); // Send the output buffer
?>
