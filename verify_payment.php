<?php
header('Content-Type: application/json');
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

$applicant_id = $data['applicant_id'] ?? null;
$verify_status = $data['verify_status'] ?? null;

if ($applicant_id && $verify_status) {
    $stmt = $conn->prepare("UPDATE rentapp_payment SET verify_status = ? WHERE applicant_id = ?");
    
    if ($stmt === false) {
        die(json_encode(['success' => false, 'message' => "Prepare failed: " . $conn->error]));
    }
    
    if (!$stmt->bind_param("ss", $verify_status, $applicant_id)) {
        die(json_encode(['success' => false, 'message' => "Bind param failed: " . $stmt->error]));
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => "Payment status updated successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => "Execute failed: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => "Invalid input."]);
}

$conn->close();
?>