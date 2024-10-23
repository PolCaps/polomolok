<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to select all inquiries and order by sent_date ascending
$sql = "SELECT inq_id, name, email_add, subject, message, sent_date, status FROM inquiry WHERE archived = 0 AND status = 'Delivered' ORDER BY sent_date ASC";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Format the sent_date to a more readable format
        $dateTime = new DateTime($row['sent_date']);
        $row['sent_date'] = $dateTime->format('F j, Y, g:i a'); // Example: October 23, 2024, 2:30 pm

        $data[] = $row; // Collect data for each row
    }
} else {
    $data = ['message' => 'No records found']; // Return a message if no records found
}

// Close the connection
$stmt->close();
$conn->close();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
