<?php
header('Content-Type: application/json');
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT r.request_id, v.vendor_id, v.first_name AS fn, v.last_name AS ln, current_stall, r.reason, r.reject_reason, r.request_date, r.approval_status
        FROM relocation_req r
        JOIN vendors v ON v.vendor_id = r.vendor_id
        WHERE r.approval_status = 'Rejected'
        ORDER BY r.request_date DESC";

// Execute the query
$result = $conn->query($sql);

// Check for query execution errors
if ($result === false) {
    echo json_encode(['error' => "Error executing query: " . $conn->error]);
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
