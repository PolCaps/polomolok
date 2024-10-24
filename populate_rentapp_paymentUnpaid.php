<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Include the database configuration file
include('database_config.php');

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check for connection errors
if ($conn->connect_error) {
    // Return JSON response indicating failure
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// SQL query to join rent_application and rent_payment tables
$sql = "
    SELECT 
        ra.applicant_id, 
        ra.first_name, 
        ra.middle_name, 
        ra.last_name, 
        ra.email, 
        rp.payment_status, 
        rp.proof_of_payment, 
        rp.OR_no, 
        rp.payment_date 
    FROM 
        rent_application ra 
    JOIN 
        rentapp_payment rp ON ra.applicant_id = rp.applicant_id 
    WHERE 
        ra.Approval = 'APPROVED' 
        AND rp.payment_status = 'Unpaid'
"; 

$result = $conn->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
    // Fetch each row as an associative array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return the result as a JSON object
echo json_encode(['success' => true, 'data' => $data]);

// Close the database connection
$conn->close();
?>
