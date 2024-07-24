<?php
include 'database_config.php'; 

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['delete_username'];

    if (!empty($username)) {

        // Get vendor_id for the username
        $sqlA = "SELECT vendor_id FROM vendors WHERE username = ?";
        $stmtA = $conn->prepare($sqlA);
        $stmtA->bind_param("s", $username);
        $stmtA->execute();
        $resultA = $stmtA->get_result();
        
        if ($resultA->num_rows > 0) {
            $vendor = $resultA->fetch_assoc();
            $id = $vendor['vendor_id'];

            // Update building_a table
            $sqlB = "UPDATE building_a SET stall_status = 'Vacant' WHERE vendor_id = ?";
            $stmtB = $conn->prepare($sqlB);
            $stmtB->bind_param("i", $id);
            $stmtB->execute();

            if ($stmtB->affected_rows > 0) {
                // Delete vendor_id from building_a table
                $sqlD = "DELETE FROM building_a WHERE vendor_id = ?";
                $stmtD = $conn->prepare($sqlD);
                $stmtD->bind_param("i", $id);
                $stmtD->execute();

                if ($stmtD->affected_rows > 0) {
                    // Delete from vendors table
                    $sqlC = "DELETE FROM vendors WHERE vendor_id = ?";
                    $stmtC = $conn->prepare($sqlC);
                    $stmtC->bind_param("i", $id);
                    $stmtC->execute();

                    if ($stmtC->affected_rows > 0) {
                        echo "Vendor deleted successfully.";
                    } else {
                        echo "Error: Vendor not deleted.";
                    }
                    $stmtC->close();
                } else {
                    echo "Error: Vendor_id not deleted from building_a.";
                }
                $stmtD->close();
            } else {
                echo "Error: Vendor's stall status not updated. No rows affected.";
            }

            $stmtB->close();
        } else {
            echo "Error: Vendor not found.";
        }

        $stmtA->close();
    } else {
        echo "No vendor selected.";
    }
}

$conn->close();
?>
