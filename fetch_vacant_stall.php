<?php
// fetch_vacant_stalls.php

header('Content-Type: application/json');

// Check if this is an AJAX request to fetch vacant stalls
if (isset($_GET['building'])) {
    include('database_config.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($mysqli->connect_error) {
        echo json_encode(['error' => 'Database connection error.']);
        exit;
    }

    $building = $_GET['building'];
    $allowedBuildings = ['building_a', 'building_b', 'building_c', 'building_d', 'building_e', 
                         'building_f', 'building_g', 'building_h', 'building_i', 'building_j'];

    if (in_array($building, $allowedBuildings)) {
        $stmt = $mysqli->prepare("SELECT stall_no FROM $building WHERE stall_status = 'Vacant'");
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            $vacantStalls = [];
            while ($row = $result->fetch_assoc()) {
                $vacantStalls[] = $row['stall_no'];
            }

            echo json_encode($vacantStalls);
        } else {
            echo json_encode(['error' => 'Failed to prepare the SQL statement.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid building specified.']);
    }

    $mysqli->close();
    exit;
}
?>