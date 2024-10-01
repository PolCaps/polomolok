<?php
header('Content-Type: application/json');
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT applicant_id, first_name, middle_name, last_name, payment_status, proof_of_payment, OR_no, payment_date 
        FROM rentapp_payment 
        WHERE payment_status = 'Unpaid'";
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