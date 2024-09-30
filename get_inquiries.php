<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement with placeholders
$sql = "SELECT inq_id, name, email_add, subject, message, sent_date FROM inquiry";
$params = [];
$types = '';

if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $sql .= " WHERE sent_date BETWEEN ? AND ?";
    $params = [$start_date, $end_date];
    $types = 'ss'; // Types of parameters: 's' for string
}

// Prepare the statement
$stmt = $conn->prepare($sql);

if ($params) {
    $stmt->bind_param($types, $params);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = ['message' => 'No records found'];
}

// Close the connection
$stmt->close();
$conn->close();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
