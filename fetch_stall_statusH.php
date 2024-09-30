<?php
include 'database_config.php'; // Include your database connection

// Check if the stall_no is provided
if (isset($_GET['stall_no'])) {
    $stall_no = $_GET['stall_no'];

    // Create a new MySQLi connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Modify the SQL query to include first_name, middle_name, and last_name
    $stmt = $conn->prepare("
        SELECT building_h.stall_status, vendors.first_name, vendors.middle_name, vendors.last_name
        FROM building_h
        LEFT JOIN vendors ON building_h.vendor_id = vendors.vendor_id
        WHERE building_h.stall_no = ?
    ");
    $stmt->bind_param("s", $stall_no);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the stall status and vendor name
    if ($row = $result->fetch_assoc()) {
        $stall_status = $row['stall_status'];
        $first_name = $row['first_name'] ?? '';
        $middle_name = $row['middle_name'] ?? ''; // Optional middle name
        $last_name = $row['last_name'] ?? '';

        // Construct the full name of the vendor
        $vendor_name = trim("$first_name $middle_name $last_name") ?: 'No occupant'; // Default to 'No occupant' if name is empty

        // Return both the stall status and full vendor name
        echo json_encode([
            'stall_status' => $stall_status,
            'vendor_name' => $vendor_name
        ]);
    } else {
        echo json_encode(['stall_status' => 'Status not found', 'vendor_name' => 'No occupant']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['stall_status' => 'Invalid request', 'vendor_name' => 'No occupant']);
}
?>