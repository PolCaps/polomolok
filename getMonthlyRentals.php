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

    // Prepare the SQL query to sum monthly rentals across all tables for the specified vendor_id
    $sql = "
        SELECT 
            SUM(CAST(REPLACE(monthly_rentals, ',', '') AS DECIMAL(10,2))) AS total_monthly_rentals
        FROM (
            SELECT monthly_rentals FROM building_a WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_b WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_c WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_d WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_e WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_f WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_g WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_h WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_i WHERE vendor_id = ?
            UNION ALL
            SELECT monthly_rentals FROM building_j WHERE vendor_id = ?
        ) AS combined
    ";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the vendorId for each UNION ALL statement
    $stmt->bind_param("iiiiiiiiii", $vendorId, $vendorId, $vendorId, $vendorId, $vendorId, $vendorId, $vendorId, $vendorId, $vendorId, $vendorId);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    $monthly_rent = 0; // Default to 0

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $monthly_rent = $row['total_monthly_rentals'];
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Return the monthly rentals as JSON
    echo json_encode(['success' => true, 'monthly_rentals' => $monthly_rent]);
} else {
    echo json_encode(['success' => false, 'message' => 'Vendor ID not specified']);
}
?>
