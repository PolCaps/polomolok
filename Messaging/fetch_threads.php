<?php
include('database_config.php');

$user_id = $_POST['id'];

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch the existing message threads for this user
$sql = "SELECT mt.thread_id, mt.subject, md.content, md.timestamp, u.first_name, u.last_name 
        FROM message_thread mt
        LEFT JOIN message_details md ON mt.thread_id = md.thread_id
        LEFT JOIN users u ON md.sender_id = u.id
        WHERE mt.participants LIKE '%$user_id%'
        ORDER BY md.timestamp DESC";
        
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li class="clearfix">';
        echo '<div class="message-data">';
        echo '<span class="text-primary">' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</span>';
        echo '<span class="message-data-time">' . htmlspecialchars($row['timestamp']) . '</span>';
        echo '</div>';
        echo '<div class="message my-message">' . htmlspecialchars($row['content']) . '</div>';
        echo '</li>';
    }
} else {
    // If no threads found, indicate that and show the input field for a new message
    echo '<li class="clearfix"><div class="message my-message">No conversation found. Start a new message.</div></li>';
}

$conn->close();
?>
