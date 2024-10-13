<?php
// Database connection
include('database_config.php'); // Adjust path if necessary

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the mark_read request is received
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['mark_read']) && $data['mark_read'] === true && isset($data['notif_id'])) {
    $notif_id = $data['notif_id']; // Get the notification ID from the request

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE notif_id = ?");
    
    // Check for preparation errors
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    // Bind parameters
    $stmt->bind_param("i", $notif_id); // Use the correct type for the notif_id (e.g., integer)
    
    // Execute the statement
    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
    }
    
    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
