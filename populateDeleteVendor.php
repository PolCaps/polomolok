<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if it's an AJAX request to fetch vendor usernames
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_vendors') {
    // SQL query to fetch usernames and vendor IDs
    $query = "SELECT username, vendor_id FROM vendors";
    $result = $conn->query($query);

    // Prepare an array to hold the usernames and vendor IDs
    $vendors = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $vendors[] = [
                'username' => htmlspecialchars($row['username']),
                'vendor_id' => $row['vendor_id']
            ];
        }
        if (!empty($vendors)) {
            echo json_encode(['vendors' => $vendors]);
        } else {
            echo json_encode(['error' => "No vendors found in the database."]);
        }
    } else {
        echo json_encode(['error' => "Error: " . $conn->error]);
    }
    $conn->close();
    exit(); // Stop further execution
}

?>
