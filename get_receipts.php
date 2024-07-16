<?php
session_start();
include("database_config.php");

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get stall information and vendor usernames
$sql = "SELECT v.first_name AS Fname, v.middle_name AS Mname, v.last_name AS Lname, s.building_type AS building, s.stall_no AS stallnum, r.receipts_id AS reciepts_history
        FROM stalls s
        JOIN vendors v ON s.vendor_id = v.vendor_id
        JOIN receipts r ON v.vendor_id = r.vendor_id
        ";

$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo json_encode([]);
    exit;
}

$conn->close();

// Return data as JSON
echo json_encode($data);
exit;
?>
