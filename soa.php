<?php

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database configuration
    include('database_config.php');

    // Create a connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    // Get the vendor ID from the POST request
    $vendorId = $_POST['vendor_id'];

    // Query to fetch file path from the database
    $sql = "SELECT file_path FROM vendorsoa WHERE vendor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vendorId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row['file_path'];

        $data = [
            'success' => true,
            'filePath' => $filePath
        ];
        
        // Output JSON
        echo json_encode($data);

        // Return the file path in the response
        echo json_encode(['success' => true, 'filePath' => $filePath]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No file found for this vendor']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
