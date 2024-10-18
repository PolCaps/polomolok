<?php

require_once 'database_config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve form data
        $stall_no = $_POST['stall_no'];
        $building_type = $_POST['building_type'];
        $monthly_rentals = $_POST['monthly_rentals'];
        $building_floor = $_POST['building_floor'];
        $vendor_id = $_POST['vendor_id'];

        if (empty($vendor_id)) {
            throw new Exception('Vendor ID is missing.');
        }

        // Start transaction
        $conn->begin_transaction();

        // Determine building table
            // Determine building table
            switch ($building_type) {
                case 'building_a':
                    $building_table = 'building_a';
                    break;
                case 'building_b':
                    $building_table = 'building_b';
                    break;
                case 'building_c':
                    $building_table = 'building_c';
                    break;
                case 'building_d':
                    $building_table = 'building_d';
                    break;
                case 'building_e':
                    $building_table = 'building_e';
                    break;
                case 'building_f':
                    $building_table = 'building_f';
                    break;
                case 'building_g':
                    $building_table = 'building_g';
                    break;
                case 'building_h':
                    $building_table = 'building_h';
                    break;
                case 'building_i':
                    $building_table = 'building_i';
                    break;
                case 'building_j':
                    $building_table = 'building_j';
                    break;
                default:
                    throw new Exception('Invalid building type.');
            }

        // Update building with vendor_id
        $sql_building_update = "UPDATE $building_table SET vendor_id = ? WHERE stall_no = ?";
        $stmt_building_update = $conn->prepare($sql_building_update);
        if (!$stmt_building_update) {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }
        $stmt_building_update->bind_param("is", $vendor_id, $stall_no);
        $stmt_building_update->execute();

        // Check the number of affected rows
        if ($stmt_building_update->affected_rows == 0) {
            throw new Exception('No rows updated in the building table. Check the stall_no value.');
        }

        // Determine stall status
        $stall_status = ($vendor_id !== null) ? 'Occupied' : 'Vacant';

        // Update stall status
        $sql = "UPDATE $building_type SET stall_status = ? WHERE stall_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $stall_status, $stall_no);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Success response
        echo "SUCCESS";
    } catch (Exception $e) {
        $conn->rollback();
        // Error response
        echo "<script>alert('An error occurred: " . $e->getMessage() . "'); window.location.href = 'AMvendor.php';</script>";
    }
}
$conn->close();

?>
