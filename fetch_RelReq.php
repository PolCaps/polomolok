<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the SQL query
$sql = "SELECT r.relocation_id, v.first_name AS fn, v.last_name AS ln, r.message, r.date_sent, relocation_status AS relocation_status
        FROM relocation_req r
        LEFT JOIN vendors v ON r.vendor_id = v.vendor_id";

// Execute the query
$result = $conn->query($sql);

// Check for query execution errors
if ($result === false) {
    echo "Error executing query: " . $conn->error;
} else if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} 

echo json_encode($data);

$conn->close();
?>