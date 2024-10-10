<?php
// Database connection
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you are sending a JSON payload
$data = json_decode(file_get_contents('php://input'), true);

$senderId = $data['senderId'];
$recipientId = $data['recipientId'];
$message = $data['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO messages (sender_id, recipient_id, message) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $senderId, $recipientId, $message);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>