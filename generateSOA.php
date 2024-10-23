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

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Extract values from POST and check if they are set
    $vendorId = $_POST['vendor-id'] ?? null;
    $username = $_POST['name'] ?? null;
    $message = $_POST['reminderMessage'] ?? null;
    $otherFee = $_POST['remaining-balance'] ?? null;
    $monthlyRent = $_POST['totalPay'] ?? null;
    $monthBill = $_POST['monthBill'] ?? null;
    $building = $_POST['building'] ?? null;
    $stallNumber = $_POST['stallNumber'] ?? null;
    $dueDate = $_POST['dueDate'] ?? null;
    $totalFees = $_POST['total_fees'] ?? null;
    $penaltyFee = $_POST['penaltyFee'] ?? null;

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

            if ($resultCheck->num_rows > 0) {
                // Vendor ID exists, update the record
                $sqlUpdate = "UPDATE vendorsoa SET username = ?, message = ?, monthly_rentals = ?, other_fees = ?, total_amount = ?, file_path = ? WHERE vendor_id = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ssssssi", $username, $message, $monthlyRent, $otherFee, $totalFees, $filePath, $vendorId);

                if ($stmtUpdate->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Statement of Account updated successfully!']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update statement in database: ' . addslashes($stmtUpdate->error)]);
                }

                $stmtUpdate->close();
            } else {
                // Vendor ID does not exist, insert a new record
                $sqlInsert = "INSERT INTO vendorsoa (vendor_id, username, message, monthly_rentals, other_fees, total_amount, file_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("issssss", $vendorId, $username , $message, $monthlyRent, $otherFee, $totalFees, $filePath);

                if ($stmtInsert->execute()) {
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

ob_end_flush(); // Send the output buffer
?>