<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'relocation_id' is set
if (isset($_POST['relocation_id'])) {
    $relocation_id = intval($_POST['relocation_id']); // Sanitize input to integer

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE relocation_req SET archive = 1 WHERE request_id = ?");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $relocation_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo 'Record is now in Relocation Request History';
            exit; // Stop further execution
        } else {
            echo 'Error archiving record: ' . htmlspecialchars($stmt->error);
            exit; // Stop further execution
        }

        // Close the statement
        $stmt->close();
    } else {
        echo 'Error preparing statement: ' . htmlspecialchars($conn->error);
        exit; // Stop further execution
    }
} else {
    echo 'No relocation ID provided.';
    exit; // Stop further execution
}

// Close the connection
$conn->close();
?>
