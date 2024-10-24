<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'relocationId' and 'status' are set
if (isset($_POST['relocationId']) && isset($_POST['status'])) {
    $id = $_POST['relocationId'];
    $status = $_POST['status'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE relocation_req SET approval_status = ? WHERE request_id = ?");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("si", $status, $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'Error updating status: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo 'Error preparing statement: ' . $conn->error;
    }
} else {
    echo 'No ID or status provided.';
}

// Close the connection
$conn->close();
?>
