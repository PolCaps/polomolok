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

if (isset($_GET['vendor_id'])) {
    $vendor_id = $_GET['vendor_id'];

    $sql = "SELECT v.vendor_id, v.first_name AS Fname, v.middle_name AS Mname, v.last_name AS Lname, r.receipt_id AS receiptsNum, r.receipt AS receipts_history, r.issued_date as Dates

            FROM vendors v
            JOIN receipts r ON v.vendor_id = r.vendor_id
            WHERE v.vendor_id = ?
            ORDER BY r.issued_date DESC";
            //<|eom_id|><|start_header_id|>assistant<|end_header_id|>

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Assuming 'r.receipt' contains only the file name like 'receipt.pdf'
            $row['receipts_history'] = 'Receipts/' . $row['receipts_history'];
            $data['receipts'][] = $row;
        }
        
    } else {
        $data['receipts'] = []; // No data found
    }

    $response['data'] = $data;
} else {
    $response['error'] = "Vendor ID not provided.";
}

$conn->close();

echo json_encode($response);
exit;
?>
