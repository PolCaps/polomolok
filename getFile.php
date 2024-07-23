<?php
// Start session to check for vendor login
session_start();

// Check if the user is logged in and is a vendor
if (!isset($_SESSION['vendor_id'])) {
    http_response_code(403);
    echo 'You are not authorized to access this file.';
    exit();
}

// Get the vendor ID from the session
$vendor_id = $_SESSION['vendor_id'];

// Include database configuration
include('database_config.php');

// Create a connection
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

// Check if file ID is provided
if (isset($_GET['vendor_id'])) {
    $file_id = $_GET['document_id'];

    // Determine the column to fetch based on the provided ID
    $columns = ['lease_agreements', 'business_permits', 'business_license'];
    $column = null;

    foreach ($columns as $col) {
        if ($file_id == $col) {
            $column = $col;
            break;
        }
    }

    if ($column) {
        $stmt = $pdo->prepare("SELECT $column AS file_data FROM documents WHERE vendor_id = ?");
        $stmt->execute([$vendor_id]);
        $file = $stmt->fetch();

        if ($file && $file['file_data']) {
            header('Content-Type: image/jpeg'); // Assuming the images are JPEGs
            echo $file['file_data'];
            exit();
        } else {
            http_response_code(404);
            echo 'File not found.';
        }
    } else {
        http_response_code(400);
        echo 'Invalid file ID specified.';
    }
} else {
    http_response_code(400);
    echo 'No file ID specified.';
}
?>
