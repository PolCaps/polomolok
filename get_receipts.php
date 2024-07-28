<?php
session_start();
include("database_config.php");

header('Content-Type: application/json');

$response = [];

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    $response['error'] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit;
}

$sql = "SELECT v.vendor_id, v.first_name AS Fname, v.middle_name AS Mname, v.last_name AS Lname, r.receipt_id AS receiptsNum, r.receipts AS receipts_history
        FROM vendors v
        JOIN receipts r ON v.vendor_id = r.vendor_id";

$result = $conn->query($sql);

if ($result === false) {
    $response['error'] = "Error executing query: " . $conn->error;
    echo json_encode($response);
    exit;
}

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data['receipts'][] = $row;
    }
} else {
    $data['receipts'] = [];
}

$response['data'] = $data;

$conn->close();

echo json_encode($response);
exit;
?>
