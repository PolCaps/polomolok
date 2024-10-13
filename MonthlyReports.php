<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo "<script>alert('Connection failed: " . addslashes($conn->connect_error) . "');</script>";
    exit; // Stop execution after displaying the alert
}

// Initialize variables
$totalPayments = 0;
$inquiryCount = 0;
$rentAppCount = 0;
$activeVendorsCount = 0;

// Get total payments
$result = $conn->query("SELECT SUM(totalPay) AS totalPayments FROM receipts WHERE MONTH(issued_date) = MONTH(CURRENT_DATE) AND YEAR(issued_date) = YEAR(CURRENT_DATE)");

if ($result) {
    $totalPayments = $result->fetch_assoc()['totalPayments'] ?? 0; // Set default to 0 if null
} else {
    echo "<script>alert('Error fetching total payments: " . addslashes($conn->error) . "');</script>";
}

// Get inquiries
$result = $conn->query("SELECT COUNT(*) AS inquiry_count FROM inquiry WHERE MONTH(sent_date) = MONTH(CURRENT_DATE) AND YEAR(sent_date) = YEAR(CURRENT_DATE)");

if ($result) {
    $inquiryCount = $result->fetch_assoc()['inquiry_count'] ?? 0; // Set default to 0 if null
} else {
    echo "<script>alert('Error fetching inquiries: " . addslashes($conn->error) . "');</script>";
}

// Get rent applications
$result = $conn->query("SELECT COUNT(*) AS rent_app_count FROM rent_application WHERE MONTH(applied_date) = MONTH(CURRENT_DATE) AND YEAR(applied_date) = YEAR(CURRENT_DATE)");

if ($result) {
    $rentAppCount = $result->fetch_assoc()['rent_app_count'] ?? 0; // Set default to 0 if null
} else {
    echo "<script>alert('Error fetching rent applications: " . addslashes($conn->error) . "');</script>";
}

// Get active vendors
$result = $conn->query("SELECT COUNT(*) AS active_vendors_count FROM vendors WHERE Vendor_Status = 'ACTIVE'");

if ($result) {
    $activeVendorsCount = $result->fetch_assoc()['active_vendors_count'] ?? 0; // Set default to 0 if null
} else {
    echo "<script>alert('Error fetching active vendors: " . addslashes($conn->error) . "');</script>";
}



// Check if the PDF is set in the POST request
if (isset($_POST['pdf'])) {
    // Get the current year and month
    $yearMonth = date('Y-m'); // Format: YYYY-MM
    $reportDir = "Monthly Reports/{$yearMonth}"; // Adjust the path as needed

    // Create directory if it doesn't exist
    if (!file_exists($reportDir)) {
        mkdir($reportDir, 0777, true);
    }

    // Get the Base64 PDF string and remove the prefix
    $pdfData = $_POST['pdf'];
    $pdfData = str_replace('data:application/pdf;base64,', '', $pdfData);
    $pdfData = str_replace(' ', '+', $pdfData); // Handle spaces

    // Decode the Base64 string
    $pdfContent = base64_decode($pdfData);

    // Define the file path to save the PDF
    $filePath = "{$reportDir}/Monthly_Report.pdf";

    // Save the PDF to the specified path
    if (file_put_contents($filePath, $pdfContent) === false) {
        echo "<script>alert('Failed to save the PDF file.');</script>";
    } else {
        // Insert data into monthlyReports table
        $stmt = $conn->prepare("INSERT INTO monthlyReports (totalPayments, inquiry_count, rent_app_count, active_vendors_count, report_date, report_file) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("diisss", $totalPayments, $inquiryCount, $rentAppCount, $activeVendorsCount, date('Y-m-d'), $filePath);
            $stmt->execute();

            // Check if the insert was successful
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Report generated and saved successfully.');</script>";
            } else {
                echo "<script>alert('Failed to save report to the database: " . addslashes($stmt->error) . "');</script>";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "<script>alert('Failed to prepare statement: " . addslashes($conn->error) . "');</script>";
        }
    }
}

// Close connection
$conn->close();
?>
