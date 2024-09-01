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

    // Initialize monthly rent to 0
    $monthly_rent = 0;

    // Fetch monthly rentals from various tables
    $tables = ['building_a', 'building_b', 'building_c', 'building_d', 'building_e', 'building_f', 'building_g', 'building_h', 'building_i', 'building_j'];

    foreach ($tables as $table) {
        $sql = "SELECT monthly_rentals FROM $table WHERE vendor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $vendorId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $monthly_rent = $row['monthly_rentals'];
            break; // Stop searching once we find the value
        }
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
