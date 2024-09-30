<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'applicant_id' is set
if (isset($_POST['applicant_id'])) {
    $applicant_id = intval($_POST['applicant_id']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM rent_application WHERE applicant_id = ?");
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('i', $applicant_id);

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
    echo 'No applicant ID provided.';
}

// Close the connection
$conn->close();
?>
