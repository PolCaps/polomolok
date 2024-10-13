<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Ensure required data is present
if (empty($data['message']) || empty($data['recipient'])) {
    echo json_encode(['success' => false, 'error' => "Missing message or recipient"]);
    exit();
}

// Extract values
$message = $data['message'];
$sender_id = $_SESSION['user_id']; // Assuming the user ID is stored in session
$recipient_id = $data['recipient'];

// Check for existing thread
$queryThread = "SELECT thread_id FROM message_thread WHERE participants LIKE '%$sender_id%' AND participants LIKE '%$recipient_id%'";
$resultThread = $conn->query($queryThread);

if ($resultThread->num_rows > 0) {
    // If a thread exists, get the thread_id
    $thread_id = $resultThread->fetch_assoc()['thread_id'];
} else {
    // If no thread exists, create a new one
    $participants = implode(',', [$sender_id, $recipient_id]);
    $queryNewThread = "INSERT INTO message_thread (subject, participants) VALUES ('Chat between $sender_id and $recipient_id', '$participants')";
    
    if ($conn->query($queryNewThread) === TRUE) {
        $thread_id = $conn->insert_id; // Get the new thread_id
    } else {
        echo json_encode(['success' => false, 'error' => "Error creating thread: " . $conn->error]);
        exit();
    }
}

// Insert the message into the message_details table
$queryMessage = "INSERT INTO message_details (thread_id, sender_id, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($queryMessage);
$stmt->bind_param('iis', $thread_id, $sender_id, $message);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'thread_id' => $thread_id]);
} else {
    echo json_encode(['success' => false, 'error' => "Error sending message: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
