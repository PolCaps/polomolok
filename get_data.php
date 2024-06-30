<?php
// Include database configuration
include('database_config.php');

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT first_name, middle_name, last_name, building_type, store_number, monthly_payment FROM users_account WHERE user_type = 'Vendor'";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Output data as JSON
    echo json_encode($data);
} else {
    echo json_encode(array('message' => 'No data found'));
}

// Close connection
$conn->close();
?>
