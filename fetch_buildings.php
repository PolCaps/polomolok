<?php
// Include database configuration
include("database_config.php");

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX request
if (isset($_GET['building'])) {
  $building = $_GET['building'];

  $valid_buildings = ['building_a', 'building_b', 'building_c', 'building_d', 'building_e', 'building_f', 'building_g', 'building_h', 'building_i', 'building_j'];

  if (in_array($building, $valid_buildings)) {
    $sql = "SELECT vendor_id, stall_status, stall_no, building_floor, monthly_rentals FROM $building";
    $result = $conn->query($sql);

    $stalls = [];
    while ($row = $result->fetch_assoc()) {
      $stalls[] = $row;
    }

    echo json_encode($stalls);
  } else {
    echo json_encode([]);
  }

  $conn->close();
  exit;
}
?>