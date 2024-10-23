<?php
include('database_config.php');

header('Content-Type: application/json');

if (isset($_GET['vendor_id'])) {
    $vendorId = intval($_GET['vendor_id']);

    // Create a connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    // Prepare the SQL query to get the vendor name, total monthly rentals, building names, and stall numbers
    $sql = "
        SELECT 
            CONCAT(v.first_name, ' ', v.middle_name, ' ', v.last_name) AS vendor_name, 
            SUM(CAST(REPLACE(b.monthly_rentals, ',', '') AS DECIMAL(10,2))) AS total_monthly_rentals,
            GROUP_CONCAT(DISTINCT b.building_name SEPARATOR ', ') AS buildings,
            GROUP_CONCAT(DISTINCT b.stall_no SEPARATOR ', ') AS stall_no
        FROM vendors v
        LEFT JOIN (
            SELECT 'Building A' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_a
            UNION ALL
            SELECT 'Building B' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_b
            UNION ALL
            SELECT 'Building C' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_c
            UNION ALL
            SELECT 'Building D' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_d
            UNION ALL
            SELECT 'Building E' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_e
            UNION ALL
            SELECT 'Building F' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_f
            UNION ALL
            SELECT 'Building G' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_g
            UNION ALL
            SELECT 'Building H' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_h
            UNION ALL
            SELECT 'Building I' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_i
            UNION ALL
            SELECT 'Building J' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_j
        ) AS b ON v.vendor_id = b.vendor_id
        WHERE v.vendor_id = ?
    ";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the vendorId
    $stmt->bind_param("i", $vendorId);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    $vendor_name = '';
    $monthly_rent = 0; // Default to 0
    $buildings = '';
    $stall_no = '';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vendor_name = $row['vendor_name'];
        $monthly_rent = $row['total_monthly_rentals'];
        $buildings = $row['buildings'];
        $stall_no = $row['stall_no'];
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Return the monthly rentals, vendor name, buildings, and stall numbers as JSON
    echo json_encode([
        'success' => true,
        'vendor_name' => $vendor_name,
        'monthly_rentals' => $monthly_rent,
        'buildings' => $buildings,
        'stall_no' => $stall_no
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Vendor ID not specified']);
}
?>
