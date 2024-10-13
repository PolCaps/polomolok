<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}


// Fetch the last 50 messages from the database
$query = "SELECT content, sender_id FROM messages ORDER BY timestamp DESC LIMIT 50";
$result = mysqli_query($conn, $query);

$messages = [];
while($row = mysqli_fetch_assoc($result)) {
    $messages[] = [
        'content' => $row['content'],
        'type' => $row['sender_id'] == 1 ? 'my-message' : 'other-message'
    ];
}

echo json_encode($messages);
?>
