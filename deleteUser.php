<?php
include("database_config.php");

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'] ?? null;

if ($userId) {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("s", $userId); // Use "s" for string; adjust if necessary based on your data type

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            // User deleted successfully
            echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
        } else {
            // User not found
            echo json_encode(['success' => false, 'message' => 'User not found.']);
        }
    } else {
        // Error executing the statement
        echo json_encode(['success' => false, 'message' => 'Error executing deletion.']);
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid user ID.']);
}

$conn->close(); // Close the database connection
?>
