<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get data from POST request
$vendor_id = $_POST['vendor_id'];
$message = $_POST['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO relocation_req (vendor_id, message) VALUES (?, ?)");
$stmt->bind_param("is", $vendor_id, $message);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>