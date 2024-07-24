<?php
header('Content-Type: application/json');
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$applicant_id = $_POST['applicant_id'] ?? null;
$OR_no = $_POST['OR_no'] ?? null;

// Debug output for received data
error_log("Received applicant_id: " . $applicant_id);
error_log("Received OR_no: " . $OR_no);

// Handle file upload
if (isset($_FILES['proof_of_payment']) && $_FILES['proof_of_payment']['error'] == UPLOAD_ERR_OK) {
    $file_tmp_name = $_FILES['proof_of_payment']['tmp_name'];
    $file_name = $_FILES['proof_of_payment']['name'];
    $upload_dir = 'payment_proofs/rent_application/';
    $file_path = $upload_dir . basename($file_name);

    // Ensure the upload directory exists and is writable
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            die(json_encode(['success' => false, 'message' => "Failed to create upload directory."]));
        }
    }

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($file_tmp_name, $file_path)) {
        // Prepare and bind for insertion
        $stmt = $conn->prepare("INSERT INTO rentapp_payment (applicant_id, OR_no, proof_of_payment) VALUES (?, ?, ?)");
        
        if ($stmt === false) {
            die(json_encode(['success' => false, 'message' => "Prepare failed: " . $conn->error]));
        }
        
        if (!$stmt->bind_param("sss", $applicant_id, $OR_no, $file_path)) {
            die(json_encode(['success' => false, 'message' => "Bind param failed: " . $stmt->error]));
        }

        if ($stmt->execute()) {
            // Prepare and bind for updating status
            $stmt_update = $conn->prepare("UPDATE rentapp_payment SET payment_status = 'Paid' WHERE applicant_id = ?");
            
            if ($stmt_update === false) {
                die(json_encode(['success' => false, 'message' => "Prepare update failed: " . $conn->error]));
            }
            
            if (!$stmt_update->bind_param("s", $applicant_id)) {
                die(json_encode(['success' => false, 'message' => "Bind update param failed: " . $stmt_update->error]));
            }

            if ($stmt_update->execute()) {
                echo json_encode(['success' => true, 'message' => "Payment information submitted and status updated successfully."]);
            } else {
                echo json_encode(['success' => false, 'message' => "Execute update failed: " . $stmt_update->error]);
            }

            $stmt_update->close();
        } else {
            echo json_encode(['success' => false, 'message' => "Execute insert failed: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => "Failed to move uploaded file."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "File upload error. Please try again."]);
}

$conn->close();
?>