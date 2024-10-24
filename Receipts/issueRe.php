<?php

include("database_config.php");

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "<br>";
    echo "<a href='../CMRecieptVendor.php'>Go back</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if (isset($_POST['vendorSelect'], $_POST['vendor_id'], $_POST['username'], $_POST['totalPayment'])) {
    $vendor_id = $_POST['vendor_id']; // Ensure this is set
    $totalVenPay = $_POST['totalPayment'];
    $receiptNumber = $_POST['receiptNo'];
    $notes = $_POST['receiptNotes'] ?? '';
    $username = $_POST['username'];

    // API Key and other constants
    $apiKey = 'sk_2akVMMzyVTB5wlYV8Bjli2lWg1od59Ac';
    $from = "MEEDO / POLOMOLOK PUBLIC MARKET";
    $logo = "assets/imgbg/BGImage.png";
    $date = date("Y-m-d"); // Current date

    $sqlVendor = "
    SELECT 
        v.username,
        CONCAT(v.first_name, ' ', v.middle_name, ' ', v.last_name) AS name,
        SUM(CAST(REPLACE(b.monthly_rentals, ',', '') AS DECIMAL(10,2))) AS total_monthly_rentals,
        GROUP_CONCAT(DISTINCT b.building_name SEPARATOR ', ') AS buildings,
        GROUP_CONCAT(DISTINCT b.stall_no SEPARATOR ', ') AS stall_no
    FROM vendors v
    LEFT JOIN (
        SELECT 'Building A' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_a
        UNION ALL
        SELECT 'Building B' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_b
        UNION ALL
        SELECT 'Building C' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_c
        UNION ALL
        SELECT 'Building D' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_d
        UNION ALL
        SELECT 'Building E' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_e
        UNION ALL
        SELECT 'Building F' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_f
        UNION ALL
        SELECT 'Building G' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_g
        UNION ALL
        SELECT 'Building H' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_h
        UNION ALL
        SELECT 'Building I' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_i
        UNION ALL
        SELECT 'Building J' AS building_name, vendor_id, monthly_rentals, stall_no FROM building_j
    ) AS b ON v.vendor_id = b.vendor_id
    WHERE v.vendor_id = ?
    GROUP BY v.vendor_id, v.username, v.first_name, v.middle_name, v.last_name
";

$stmtVendor = $conn->prepare($sqlVendor);
if ($stmtVendor) {
    $stmtVendor->bind_param("i", $vendor_id);
    $stmtVendor->execute();
    $resultVendor = $stmtVendor->get_result();

    if ($resultVendor->num_rows > 0) {
        $rowVendor = $resultVendor->fetch_assoc();
        $username = $rowVendor['username'];
        $name = $rowVendor['name'];
        $total_monthly_rentals = $rowVendor['total_monthly_rentals'];
        $buildings = $rowVendor['buildings'];
        $stall_no = $rowVendor['stall_no'];
    } else {
        echo "<script>alert('Vendor not found.'); window.location.href = '../CMReceiptVendor.php';</script>";
        exit;
    }
    $stmtVendor->close();
} else {
    echo "<script>alert('SQL prepare error: " . $conn->error . "'); window.location.href = '../CMReceiptVendor.php';</script>";
    exit;
}

try {
    // Validate essential fields
    if (empty($from)) {
        throw new Exception("The 'from' field is missing.");
    }
    if (empty($name)) {
        throw new Exception("The 'to' (vendor name) field is missing.");
    }
    if (empty($logo)) {
        throw new Exception("The 'logo' field is missing.");
    }
    if (empty($receiptNumber)) {
        throw new Exception("The 'official receipt' field is missing.");
    }
    if (!is_numeric($totalVenPay) || $totalVenPay <= 0) {
        throw new Exception("Total payment value is invalid.");
    }
    if (!is_numeric($total_monthly_rentals) || $total_monthly_rentals <= 0) {
        throw new Exception("Monthly rental value is invalid.");
    }


    $data = array(
        "from" => $from,
        "to" => $name,
        "logo" => $logo,
        "number" => 1,
        "date" => $date,
        "custom_fields[0][name]" => "TOTAL PAYMENTS",
        "custom_fields[0][value]" => $totalVenPay,
        "custom_fields[1][name]" => "OFFICIAL RECEIPT",
        "custom_fields[1][value]" => $receiptNumber,
        "custom_fields[2][name]" => "BUILDINGS",
        "custom_fields[2][value]" => $buildings,
        "items[0][name]" => "Monthly Rental",
        "items[0][quantity]" => 1,
        "items[0][unit_cost]" => $total_monthly_rentals ?? 0,
        "total" => $totalVenPay - $total_monthly_rentals
    );
    
    
} catch (Exception $e) {
    // Handle the error by alerting and redirecting
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = '../CMReceiptVendor.php';</script>";
    exit;
}



    // First cURL request to generate the invoice
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://invoice-generator.com");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $apiKey"
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "<script>alert('cURL Error: " . curl_error($ch) . "'); window.location.href = '../CMReceiptVendor.php';</script>";
        curl_close($ch);
        exit;
    }

    // Decode the response for error checking
    $responseData = json_decode($response, true);
    if (isset($responseData['error'])) {
        echo "<script>alert('Error generating invoice: " . $responseData['error'] . "'); window.location.href = '../CMReceiptVendor.php';</script>";
        curl_close($ch);
        exit;
    }

    // Create the file path including the username and date
    $sanitizedUsername = preg_replace('/[^a-zA-Z0-9-_]/', '_', $username);
    $targetDir = "Receipts/file/" . $vendor_id . "/";
    
    // Check if the directory exists, if not, create it
    if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
        echo "<script>alert('Failed to create directory: " . $targetDir . "'); window.location.href = '../CMReceiptVendor.php';</script>";
        exit;
    }

    // Define the file path
    $filePath = $targetDir . $receiptNumber . ".pdf"; // Assuming you want to save the PDF with receipt number as the filename

    // Save the PDF file on the server
    if (file_put_contents($filePath, $response) === false) {
        echo "<script>alert('Failed to save receipt.'); window.location.href = '../CMReceiptVendor.php';</script>";
        exit;
    }

    // Insert new receipt record for the vendor
    $stmtInsert = $conn->prepare("INSERT INTO receipts (vendor_id, totalPay, notes, rec_num, receipt) VALUES (?, ?, ?, ?, ?)");
    if ($stmtInsert) {
        $stmtInsert->bind_param("issss", $vendor_id, $totalVenPay, $notes, $receiptNumber, $filePath);
        if ($stmtInsert->execute()) {
            echo "<script>alert('Successfully issued receipt and saved PDF!'); window.location.href = '../CMReceiptVendor.php';</script>";
        } else {
            echo "<script>alert('Error issuing receipt: " . $stmtInsert->error . "'); window.location.href = '../CMReceiptVendor.php';</script>";
        }
        $stmtInsert->close();
    } else {
        echo "<script>alert('SQL prepare error: " . $conn->error . "'); window.location.href = '../CMReceiptVendor.php';</script>";
    }
    
    curl_close($ch);
} else {
    echo "<script>alert('Fill all the fields.'); window.location.href = '../CMReceiptVendor.php';</script>";
}

$conn->close();
}

?>