<?php
session_start();
require_once 'database_config.php';

if (!isset($_SESSION['vendor_id'])) {
    echo json_encode([]);
    exit();
}

$vendor_id = $_SESSION['vendor_id'];
$sql = "SELECT first_name, middle_name, last_name, age, contact_no, address, email_add FROM vendors WHERE vendor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendor_id);
$stmt->execute();
$result = $stmt->get_result();
$vendor = $result->fetch_assoc();
$stmt->close();

// Send the vendor data as JSON
echo json_encode($vendor);
?>
