<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$vendor_id = $vendor['vendor_id']; // Assume $vendor_id is set earlier in your script

// Fetch data
$sql = "SELECT message, relocation_status FROM relocation_req WHERE vendor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendor_id);
$stmt->execute();
$result = $stmt->get_result();

// Display data
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td class='text-center'>" . htmlspecialchars($row['message']) . "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['relocation_status']) . "</td>";
    echo "</tr>";
}

// Close connections
$stmt->close();
$conn->close();
?>