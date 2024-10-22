<?php
include('database_config.php');

$recipientId = $_GET['recipient_id'];
$currentUserId = 1; // Replace with session or actual logged-in user ID

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Check if a thread already exists between these two users
$sql = "SELECT thread_id FROM message_thread 
        WHERE (sender_id = $currentUserId AND recipient_id = $recipientId) 
        OR (sender_id = $recipientId AND recipient_id = $currentUserId)";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $thread = $result->fetch_assoc();
    $threadId = $thread['thread_id'];

    // Fetch messages in the existing thread
    $sqlMessages = "SELECT details, timestamp, sender_id FROM message_details WHERE thread_id = $threadId ORDER BY timestamp ASC";
    $messagesResult = $conn->query($sqlMessages);

    $messages = [];
    while ($message = $messagesResult->fetch_assoc()) {
        $messages[] = [
            'details' => htmlspecialchars($message['details']),
            'timestamp' => $message['timestamp'],
            'sender' => $message['sender_id'] == $currentUserId
        ];
    }

    echo json_encode(['thread_id' => $threadId, 'messages' => $messages]);
} else {
    // No existing thread found
    echo json_encode(['thread_id' => null]);
}

$conn->close();
?>
