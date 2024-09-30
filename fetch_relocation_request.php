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
    echo "<td class='text-center'>";
    $message = htmlspecialchars($row['message']);
    $trimmedMessage = strlen($message) > 50 ? substr($message, 0, 50) . '...' : $message;
    echo "<span data-bs-toggle='modal' data-bs-target='#messageModalEnlarge' data-message='" . $message . "' class='message-preview'>" . $trimmedMessage . "</span>";
    echo "</td>";
    echo "<td class='text-center'>" . htmlspecialchars($row['relocation_status']) . "</td>";
    echo "</tr>";
}

// Close connections
$stmt->close();
$conn->close();
?>