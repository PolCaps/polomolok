<?php
header('Content-Type: application/json');
include('database_config.php');

// Create a new MySQL connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Fetch form data
$applicant_id = $_POST['applicant_id'] ?? null;
$payment_status = $_POST['payment_status'] ?? null;
$OR_no = $_POST['OR_no'] ?? null;
$payment_date = $_POST['payment_date'] ?? null;
$proof_of_payment = $_FILES['proof_of_payment'] ?? null;

// Validate required fields
if (!$applicant_id || !$payment_status) {
    die(json_encode(['success' => false, 'message' => "Applicant ID and Payment Status are required."]));
}

// Handle file upload if proof_of_payment is provided
$proof_of_payment_path = null;
if ($proof_of_payment) {
    $target_dir = "payment_proofs/rent_application";
    $file_name = basename($proof_of_payment['name']);
    $target_file = $target_dir . uniqid() . '_' . $file_name;
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($proof_of_payment['tmp_name'], $target_file)) {
        $proof_of_payment_path = $target_file; // Store the file path in the database
    } else {
        die(json_encode(['success' => false, 'message' => 'Failed to upload proof of payment.']));
    }
}

// Prepare the SQL query
$query = "UPDATE rentapp_payment 
          SET payment_status = ?, OR_no = ?, payment_date = ?, proof_of_payment = ?
          WHERE applicant_id = ?";

$stmt = $conn->prepare($query);

if ($stmt === false) {
    die(json_encode(['success' => false, 'message' => "Prepare failed: " . $conn->error]));
}

// Bind the parameters and execute
$stmt->bind_param("sssss", $payment_status, $OR_no, $payment_date, $proof_of_payment_path, $applicant_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Payment details updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => "Execute failed: " . $stmt->error]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
