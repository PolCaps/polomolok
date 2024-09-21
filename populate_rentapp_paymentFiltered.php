<?php
header('Content-Type: application/json');
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Update the SQL query to filter by payment_status = 'Paid'
$sql = "SELECT applicant_id, OR_no, proof_of_payment, payment_status, verify_status, payment_date 
        FROM rentapp_payment 
        WHERE verify_status = 'Verified'
        ORDER BY payment_date DESC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode(['success' => true, 'data' => $data]);

$conn->close();
?>