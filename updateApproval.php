<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'applicant_id' and 'status' are set
if (isset($_POST['applicant_id']) && isset($_POST['status'])) {
    $applicant_id = intval($_POST['applicant_id']);
    $status = $_POST['status'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE rent_application SET Approval = ? WHERE applicant_id = ?");
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('si', $status, $applicant_id);

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
    echo 'No applicant ID or status provided.';
}

// Close the connection
$conn->close();
?>
