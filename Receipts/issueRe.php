<?php

include("database_config.php");

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "<br>";
    echo "<a href='../CMReciept.php'>Go back</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    if (isset($_POST['vendorSelect'], $_POST['vendor_id'], $_POST['username'], $_FILES['receiptFile'])) {
        $vendor_id = $_POST['vendor_id']; // Get the vendor_id from POST data
        $notes = $_POST['receiptNotes'] ?? '';  // Optional notes field
        $username = $_POST['username'];  // Get the username from POST data

        // Check if vendor_id exists in vendors table
        $checkVendorStmt = $conn->prepare("SELECT vendor_id FROM vendors WHERE vendor_id = ?");
        $checkVendorStmt->bind_param("i", $vendor_id);
        $checkVendorStmt->execute();
        $checkVendorStmt->store_result();

        // $setSelectedVendorID = 

        if ($checkVendorStmt->num_rows === 0) {
            echo "<script>alert('Error: Vendor ID does not exist.'); window.location.href = '../CMReciept.php';</script>";
            exit;
        }

        // Set the directory to save the receipt based on the vendor_id
        $targetDir = "Receipts/file/" . $vendor_id . "/";
        $targetFile = $targetDir . basename($_FILES['receiptFile']['name']);

        // Check if the directory exists, if not, create it
        if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
            echo "Failed to create directory: " . $targetDir . "<br>";
            echo "<a href='../CMReciept.php'>Go back</a>";
            exit;
        }

        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES['receiptFile']['tmp_name'], $targetFile)) {
            // Now, check for existing receipts for the vendor
            $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM receipts WHERE vendor_id = ?");
            $stmtCheck->bind_param("i", $vendor_id);
            $stmtCheck->execute();
            $stmtCheck->bind_result($count);
            $stmtCheck->fetch();
            $stmtCheck->close();

            if ($count > 0) {
                // If vendor_id exists, update the record
                $stmtUpdate = $conn->prepare("UPDATE receipts SET receipt = ?, notes = ? WHERE vendor_id = ?");
                if ($stmtUpdate) {
                    $stmtUpdate->bind_param("ssi", $targetFile, $notes, $vendor_id);
                    if ($stmtUpdate->execute()) {
                        echo "<script>alert('Successfully Updated.'); window.location.href = '../CMReciept.php';</script>";
                    } else {
                        echo "Error updating receipt: " . $stmtUpdate->error . "<br>";
                    }
                    $stmtUpdate->close();
                } else {
                    echo "SQL prepare error: " . $conn->error . "<br>";
                }
            } else {
                // If vendor_id does not exist, insert a new record
                $stmtInsert = $conn->prepare("INSERT INTO receipts (vendor_id, receipt, notes) VALUES (?, ?, ?)");
                if ($stmtInsert) {
                    $stmtInsert->bind_param("iss", $vendor_id, $targetFile, $notes);
                    if ($stmtInsert->execute()) {
                        echo "<script>alert('Successfully uploaded!!'); window.location.href = '../CMReciept.php';</script>";
                    } else {
                        echo "Error issuing receipt: " . $stmtInsert->error . "<br>";
                    }
                    $stmtInsert->close();
                } else {
                    echo "SQL prepare error: " . $conn->error . "<br>";
                }
            }
        } else {
            echo "Failed to upload file!<br>";
        }
    } else {
        echo "<script>alert('Fill all the fields.'); window.location.href = '../CMReciept.php';</script>";
    }
}

$conn->close();
?>
