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
    $relocation_id = $_POST['relocation_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM relocation_req WHERE relocation_id = ?");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $relocation_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo 'Record deleted successfully.';
        } else {
            echo 'Error deleting record: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo 'Error preparing statement: ' . $conn->error;
    }
} else {
    echo 'No relocation ID provided.';
}

// Close the connection
$conn->close();
?>
