<?php
// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

error_reporting(0);
ini_set('display_errors', 0);

// Fetch the vendor ID from the JSON request
$input = json_decode(file_get_contents('php://input'), true);
$vendorId = isset($input['vendor_id']) ? $input['vendor_id'] : 0;

// Debugging output for vendorId
if ($vendorId == 0) {
    echo json_encode(['success' => false, 'message' => 'Vendor ID not provided or is invalid']);
    exit;
}

// Prepare SQL statement to fetch file path
$sql = "SELECT file_path FROM vendorsoa WHERE vendor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendorId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['file_path'];

     // Clear the output buffer to ensure no unexpected output
     ob_end_clean();

    // Debugging output for file path
    if (!empty($filePath) && file_exists($filePath)) {
        echo json_encode(['success' => true, 'message' => 'File path fetched successfully.', 'filePath' => $filePath]);

         // Clear the output buffer to ensure no unexpected output
         ob_end_clean();
    } else {
        echo json_encode(['success' => false, 'message' => 'File path is empty or file does not exist on the server. Path: ' . $filePath]);

         // Clear the output buffer to ensure no unexpected output
         ob_end_clean();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No record found for the given vendor ID.']);
}

$stmt->close();
$conn->close();
?>
