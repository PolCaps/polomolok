<?php
// Start output buffering
ob_start();

// Include your database configuration file
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo "<script>alert('Connection failed: " . $conn->connect_error . "'); window.location.href = 'CMReports.php';</script>";
    exit;
}

// Function to execute a query and return result
function executeQuery($conn, $query, $field) {
    $result = $conn->query($query);
    if (!$result) {
        echo "<script>alert('Error fetching data: " . $conn->error . "'); window.location.href = 'CMReports.php';</script>";
        exit;
    }
    return $result->fetch_assoc()[$field] ?? 0;
}

// Initialize variables
$totalPayments = executeQuery($conn, "SELECT SUM(totalPay) AS totalPayments FROM receipts WHERE MONTH(issued_date) = MONTH(CURRENT_DATE) AND YEAR(issued_date) = YEAR(CURRENT_DATE)", 'totalPayments');
$inquiryCount = executeQuery($conn, "SELECT COUNT(*) AS inquiry_count FROM inquiry WHERE MONTH(sent_date) = MONTH(CURRENT_DATE) AND YEAR(sent_date) = YEAR(CURRENT_DATE)", 'inquiry_count');
$rentAppCount = executeQuery($conn, "SELECT COUNT(*) AS rent_app_count FROM rent_application WHERE MONTH(applied_date) = MONTH(CURRENT_DATE) AND YEAR(applied_date) = YEAR(CURRENT_DATE)", 'rent_app_count');
$activeVendorsCount = executeQuery($conn, "SELECT COUNT(*) AS active_vendors_count FROM vendors WHERE Vendor_Status = 'ACTIVE'", 'active_vendors_count');

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pdf'])) {
        // Retrieve and decode the PDF Base64 data from the POST request
        $pdfData = str_replace('data:application/pdf;base64,', '', $_POST['pdf']);
        $pdfData = str_replace(' ', '+', $pdfData);

        // Validate if the PDF data is a valid base64 string
        if (base64_encode(base64_decode($pdfData, true)) !== $pdfData) {
            echo "<script>alert('Invalid Base64 data.'); window.location.href = 'CMReports.php';</script>";
            exit;
        }

        // Define the file path for saving the PDF
        $filePath = "Monthly_Reports/Monthly_Report_" . date('Y-m-d') . ".pdf";

        // Save the PDF data as a file
        if (file_put_contents($filePath, base64_decode($pdfData)) === false) {
            echo "<script>alert('Failed to save the PDF file.'); window.location.href = 'CMReports.php';</script>";
            exit;
        }

        // Prepare an SQL statement to insert report details into the database
        $stmt = $conn->prepare("INSERT INTO monthlyReports (totalPayments, inquiry_count, rent_app_count, active_vendors_count, report_date, report_file) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $reportDate = date('Y-m-d');
            $stmt->bind_param("diisss", $totalPayments, $inquiryCount, $rentAppCount, $activeVendorsCount, $reportDate, $filePath);
            $stmt->execute();

            // Check if the insertion was successful
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Report generated and saved successfully.'); window.location.href = 'CMReports.php';</script>";
            } else {
                echo "<script>alert('Failed to save report to the database: " . $stmt->error . "'); window.location.href = 'CMReports.php';</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Failed to prepare the SQL statement.'); window.location.href = 'CMReports.php';</script>";
        }
    } else {
        echo "<script>alert('No PDF data received.'); window.location.href = 'CMReports.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.location.href = 'CMReports.php';</script>";
}

// Close the database connection
$conn->close();
ob_end_flush(); // Send the output buffer content
?>
