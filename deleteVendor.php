<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'database_config.php'; 

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    echo "Connection failed: " . addslashes($conn->connect_error);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Log the received POST data
    error_log(print_r($_POST, true));

    $vendor_id = $_POST['vendor_id'];

    if (!empty($vendor_id)) {
        // Start a transaction
        $conn->begin_transaction();

        try {
            $tables = ['building_a', 'building_b', 'building_c', 'building_d', 'building_e', 
                       'building_f', 'building_g', 'building_h', 'building_i', 'building_j'];

            $updated = false; // Track if any updates were made

            // Step 1: Update stall status and vendor_id to NULL
            foreach ($tables as $table) {
                // Check if vendor_id exists in the current building table
                $sqlCheckVendor = "SELECT COUNT(*) FROM $table WHERE vendor_id = ?";
                $stmtCheck = $conn->prepare($sqlCheckVendor);
                $stmtCheck->bind_param("i", $vendor_id);
                $stmtCheck->execute();
                $stmtCheck->bind_result($count);
                $stmtCheck->fetch();
                $stmtCheck->close();

                // If vendor_id exists, update the stall_status
                if ($count > 0) {
                    // Update the stall_status to Vacant and set vendor_id to NULL
                    $sqlUpdate = "UPDATE $table SET stall_status = 'Vacant', vendor_id = NULL WHERE vendor_id = ?";
                    $stmtUpdate = $conn->prepare($sqlUpdate);
                    $stmtUpdate->bind_param("i", $vendor_id);
                    $stmtUpdate->execute();

                    if ($stmtUpdate->affected_rows > 0) {
                        $updated = true; // Mark that at least one update occurred
                    }
                    $stmtUpdate->close();
                }
            }

            // Step 2: Delete the vendor
            $sqlDeleteVendor = "DELETE FROM vendors WHERE vendor_id = ?";
            $stmtDeleteVendor = $conn->prepare($sqlDeleteVendor);
            
            // Check if preparation was successful
            if ($stmtDeleteVendor === false) {
                echo "SQL prepare error: " . addslashes($conn->error);
                exit();
            }

            $stmtDeleteVendor->bind_param("i", $vendor_id);
            $stmtDeleteVendor->execute();

            if ($stmtDeleteVendor->affected_rows > 0) {
                echo "Vendor deleted successfully!";
            } else {
                echo "Error deleting vendor from vendors table.";
            }
            $stmtDeleteVendor->close();

            // Step 3: Optionally, update any additional records if needed
            // (In this case, the vendor_id has already been set to NULL in the previous step)
            if ($updated) {
                $conn->commit();
                echo "Delete successful!";
            } else {
                echo "No updates made; vendor ID not found in any building tables.";
            }

        } catch (Exception $e) {
            // Roll back the transaction if any update fails
            $conn->rollback();
            echo "Failed to update tables: " . $e->getMessage();
        }
    } else {
        echo "No vendor selected.";
    }
}

$conn->close();
?>
