<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from the query string
$username = isset($_GET['username']) ? $conn->real_escape_string($_GET['username']) : '';

// Validate username input
if (empty($username)) {
    echo json_encode([]);
    exit();
}

// Prepare the SQL statement with a LIKE clause to search for the username
$sql = "SELECT * FROM inquiry WHERE name LIKE ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $searchTerm = '%' . $username . '%';
    $stmt->bind_param('s', $searchTerm);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch all rows
    $data = $result->fetch_all(MYSQLI_ASSOC);
    
    // Return JSON encoded data
    echo json_encode($data);
    
    // Close the statement
    $stmt->close();
} else {
    echo json_encode([]);
}

// Close the connection
$conn->close();
?>
