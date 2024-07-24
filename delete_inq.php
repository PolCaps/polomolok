<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'inq_id' is set in the POST request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['inq_id'])) {
    $inq_id = $data['inq_id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM inquiry WHERE inq_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $inq_id); // Assuming 'inq_id' is an integer

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting record: ' . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No ID provided or invalid format.']);
}

// Close the connection
$conn->close();
?>
