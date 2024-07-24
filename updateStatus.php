<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' and 'status' are set
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE relocation_req SET status = ? WHERE relocation_id = ?");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("si", $status, $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo 'Status updated successfully.';
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