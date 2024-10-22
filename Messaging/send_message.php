<?php
include('database_config.php');
$data = json_decode(file_get_contents('php://input'), true);

$recipientId = $data['recipient_id'];
$messageContent = $data['message'];
$currentUserId = $data['id']; // Replace with session or actual logged-in user ID

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Check if a thread exists or create a new one
$sql = "SELECT thread_id FROM message_thread 
        WHERE (sender_id = $currentUserId AND recipient_id = $recipientId) 
        OR (sender_id = $recipientId AND recipient_id = $currentUserId)";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $thread = $result->fetch_assoc();
    $threadId = $thread['thread_id'];
} else {
    // Create a new thread
    $sqlCreateThread = "INSERT INTO message_thread (subject, created_by, last_update, sender_id, recipient_id)
                        VALUES ('', $currentUserId, NOW(), $currentUserId, $recipientId)";
    if ($conn->query($sqlCreateThread) === TRUE) {
        $threadId = $conn->insert_id;
    } else {
        echo json_encode(['error' => 'Failed to create thread']);
        exit;
    }
}

// Insert the new message into the message_details table
$sqlInsertMessage = "INSERT INTO message_details (thread_id, details, message_type) VALUES ($threadId, ?, 'text')";
$stmt = $conn->prepare($sqlInsertMessage);
$stmt->bind_param('s', $messageContent);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to send message']);
}

$stmt->close();
$conn->close();
?>
