<?php

header('Content-Type: application/json');
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$first_name = $_POST['first_name'] ?? null;
$middle_name = $_POST['middle_name'] ?? null;
$last_name = $_POST['last_name'] ?? null;
$contact_number = $_POST['contact_number'] ?? null;
$age = $_POST['age'] ?? null;
$email = $_POST['email'] ?? null;
$building_type = $_POST['building_type'] ?? null;
$stall_no = $_POST['stall_no'] ?? null;
$address = $_POST['address'] ?? null;

// Handle file upload
if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == UPLOAD_ERR_OK) {
    $file_tmp_name = $_FILES['file_upload']['tmp_name'];
    $file_name = $_FILES['file_upload']['name'];
    $upload_dir = 'rent_applications_file_dir/';
    $file_path = $upload_dir . basename($file_name);

    // Ensure the upload directory exists and is writable
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            die(json_encode(['success' => false, 'message' => "Failed to create upload directory."]));
        }
    }

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($file_tmp_name, $file_path)) {
        // Prepare and bind for the rent_application table
        $stmt = $conn->prepare("INSERT INTO rent_application (first_name, middle_name, last_name, contact_no, age, email, building_type, stall_no, address, rentapp_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die(json_encode(['success' => false, 'message' => "Prepare failed: " . $conn->error]));
        }
        
        if (!$stmt->bind_param("ssssisssss", $first_name, $middle_name, $last_name, $contact_number, $age, $email, $building_type, $stall_no, $address, $file_path)) {
            die(json_encode(['success' => false, 'message' => "Bind param failed: " . $stmt->error]));
        }

        if ($stmt->execute()) {
            $applicant_id = $stmt->insert_id; // Get the last inserted ID

            // Insert into the rentapp_payment table
            $stmt_payment = $conn->prepare("INSERT INTO rentapp_payment (applicant_id, first_name, middle_name, last_name) VALUES (?, ?, ?, ?)");
            
            if ($stmt_payment === false) {
                die(json_encode(['success' => false, 'message' => "Prepare failed for payment: " . $conn->error]));
            }
            
            if (!$stmt_payment->bind_param("isss", $applicant_id, $first_name, $middle_name, $last_name)) {
                die(json_encode(['success' => false, 'message' => "Bind param failed for payment: " . $stmt_payment->error]));
            }

            if ($stmt_payment->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => "Success! Data inserted into both tables.",
                    'applicant_id' => $applicant_id
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => "Execute failed for payment: " . $stmt_payment->error]);
            }

            $stmt_payment->close();

        } else {
            echo json_encode(['success' => false, 'message' => "Execute failed: " . $stmt->error]);
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
