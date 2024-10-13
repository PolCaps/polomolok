<?php
// filterStalls.php

session_name('vendor_session');
session_start();

$vendor_id = $_SESSION['vendor_id'];

include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the search and filter values from the AJAX request
$buildingFilter = isset($_POST['buildingFilter']) ? $_POST['buildingFilter'] : '';
$searchValue = isset($_POST['searchValue']) ? $_POST['searchValue'] : '';

// Prepare the SQL query based on the filters
$sql = "
    SELECT stall_no, monthly_rentals, 'Building A' AS building FROM building_a WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building B' AS building FROM building_b WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building C' AS building FROM building_c WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building D' AS building FROM building_d WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building E' AS building FROM building_e WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building F' AS building FROM building_f WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building G' AS building FROM building_g WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building H' AS building FROM building_h WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building I' AS building FROM building_i WHERE stall_status = 'Vacant'
    UNION ALL
    SELECT stall_no, monthly_rentals, 'Building J' AS building FROM building_j WHERE stall_status = 'Vacant'
";

// Apply the building filter if provided
if (!empty($buildingFilter)) {
    $sql .= " AND building = '$buildingFilter'";
}

// Apply the search filter if provided
if (!empty($searchValue)) {
    $sql .= " AND (stall_no LIKE '%$searchValue%' OR monthly_rentals LIKE '%$searchValue%')";
}

// Order the results by building and stall number
$sql .= " ORDER BY building, stall_no";

$resultVacantStalls = $conn->query($sql);

$vacantStalls = [];

if ($resultVacantStalls->num_rows > 0) {
    while ($row = $resultVacantStalls->fetch_assoc()) {
        $vacantStalls[] = $row;
    }
}

// Return the filtered results as JSON
echo json_encode($vacantStalls);

$conn->close();
?>
