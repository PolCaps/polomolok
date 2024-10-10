<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT r.request_id, v.first_name AS fn, v.last_name AS ln, r.reason, r.approval_date, r.approval_status, r.maintenance_description AS descript, v.vendor_id
        FROM relocation_req r
        LEFT JOIN vendors v ON r.vendor_id = v.vendor_id
        WHERE r.approval_status = 'Approved'
        ORDER BY r.request_date DESC";


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