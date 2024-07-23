<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'ids' is set and is an array
if (isset($_POST['relocation_id']) && is_array($_POST['relocation_id']) && count($_POST['relocation_id']) > 0) {
    $ids = $_POST['relocation_id'];

    // Ensure $ids contains integer values
    $ids = array_map('intval', $ids);

    // Ensure there are IDs to process
    if (count($ids) > 0) {
        // Create placeholders for the SQL query
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        // Prepare the SQL statement with placeholders
        $stmt = $conn->prepare("DELETE FROM relocation_req WHERE relocation_id IN ($placeholders)");

        if ($stmt) {
            // Bind parameters
            $types = str_repeat('i', count($ids)); // Assuming IDs are integers
            $stmt->bind_param($types, ...$ids);

            // Execute the statement
            if ($stmt->execute()) {
                echo 'Records deleted successfully.';
            } else {
                echo 'Error deleting records: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo 'Error preparing statement: ' . $conn->error;
        }
    } else {
        echo 'No valid IDs provided.';
    }
} else {
    echo 'No IDs provided or invalid format.';
}

// Close the connection
$conn->close();
?>