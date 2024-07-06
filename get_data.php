<?php
// Include database configuration
include('database_config.php');

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data using INNER JOIN
$sql = "
SELECT 
    v.vendor_name, 
    b.building_code, 
    s.stall_number,  
    pm.monthly_payments
FROM 
    vendor v
INNER JOIN 
    buildings b ON v.building_id = b.building_id
INNER JOIN 
    stalls s ON v.stall_id = s.stall_id
INNER JOIN 
    payments pm ON v.payment_id = pm.payment_id
INNER JOIN 
    users u ON v.user_id = u.user_id
WHERE 
    u.user_type = 'VENDOR';
";

$result = $conn->query($sql);

   // Check if there are results
    if ($result === false) {
        // Handle SQL query execution error
        echo json_encode(['success' => false, 'error' => 'Error executing query: ' . $conn->error]);
    } else {
        // Check if query returned rows
        if ($result->num_rows > 0) {
            // Fetch and display the rows from the result set
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            // Output data as JSON
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            // No rows found
            echo json_encode(['success' => false, 'error' => 'No data found']);
        }
    }


// Close connection
$conn->close();
?>
