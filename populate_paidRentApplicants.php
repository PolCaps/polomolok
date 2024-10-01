<?php
// Establish a connection to the database
include 'database_config.php'; // Include the database connection

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to join the two tables and get the desired columns
$query = "
  SELECT 
    ra.applicant_id, 
    ra.first_name, 
    ra.middle_name, 
    ra.last_name, 
    ra.contact_no, 
    ra.email, 
    rp.payment_status
  FROM 
    rent_application ra
    INNER JOIN rentapp_payment rp ON ra.applicant_id = rp.applicant_id
  WHERE 
    rp.payment_status = 'Paid'
";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

// Fetch the results as an associative array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Close the connection
mysqli_close($conn);

// Output the results (e.g., for the JavaScript code to consume)
echo json_encode(array("success" => true, "data" => $data));


$data = array(
    'success' => true,
    'data' => $result // assuming $result is the data you want to fetch
);

echo json_encode($data);
?>