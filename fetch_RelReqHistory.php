<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Corrected SQL query
$sql = "SELECT r.request_id, v.first_name AS fn, v.last_name AS ln, r.relocated_stall, r.current_stall, r.reason, r.approval_date, r.approval_status, r.maintenance_description AS descript, r.archive, v.vendor_id
        FROM relocation_req r
        JOIN vendors v ON v.vendor_id = r.vendor_id
        WHERE r.approval_status = 'Approved' AND r.archive = 1
        ORDER BY r.request_date DESC"; // Removed the semicolon here

// Execute the query
$result = $conn->query($sql);

// Check for query execution errors
if ($result === false) {
    echo "Error executing query: " . $conn->error;
} else if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode([]); // Return empty array if no results
}

$conn->close();
?>
