<?php

include("database_config.php");

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "<br>";
    echo "<a href='../CMRecieptVendor.php'>Go back</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['vendorSelect'], $_POST['vendor_id'], $_POST['username'], $_POST['totalPayment'], $_FILES['receiptFile'])) {
        $vendor_id = $_POST['vendor_id'];
        $totalVenPay = $_POST['totalPayment'];
        $receiptNumber = $_POST['receiptNo'];
        $notes = $_POST['receiptNotes'] ?? '';
        $username = $_POST['username'];

        // Check if vendor_id exists in vendors table
        $checkVendorStmt = $conn->prepare("SELECT vendor_id FROM vendors WHERE vendor_id = ?");
        $checkVendorStmt->bind_param("i", $vendor_id);
        $checkVendorStmt->execute();
        $checkVendorStmt->store_result();

        if ($checkVendorStmt->num_rows === 0) {
            echo "<script>alert('Error: Vendor ID does not exist.'); window.location.href = '../CMReceiptVendor.php';</script>";
            exit;
        }

        // Set the directory to save the receipt based on the vendor_id
        $targetDir = "Receipts/file/" . $vendor_id . "/";
        $targetFile = $targetDir . basename($_FILES['receiptFile']['name']);

        // Check if the directory exists, if not, create it
        if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
            echo "Failed to create directory: " . $targetDir . "<br>";
            echo "<a href='../CMReceiptVendor.php'>Go back</a>";
            exit;
        }

        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES['receiptFile']['tmp_name'], $targetFile)) {
            // Insert new receipt record for the vendor
            $stmtInsert = $conn->prepare("INSERT INTO receipts (vendor_id, receipt, totalPay, notes, rec_num) VALUES (?, ?, ?, ?, ?)");
            if ($stmtInsert) {
                $stmtInsert->bind_param("issss", $vendor_id, $targetFile, $totalVenPay, $notes, $receiptNumber);
                if ($stmtInsert->execute()) {
                    echo "<script>alert('Successfully uploaded!'); window.location.href = '../CMReceiptVendor.php';</script>";
                } else {
                    echo "Error issuing receipt: " . $stmtInsert->error . "<br>";
                }
                $stmtInsert->close();
            } else {
                echo "SQL prepare error: " . $conn->error . "<br>";
            }
        } else {
            echo "Failed to upload file!<br>";
        }
    } else {
        echo "<script>alert('Fill all the fields.'); window.location.href = '../CMReceiptVendor.php';</script>";
    }
}


$conn->close();
?>

