<?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume $vendor_id is set earlier in your script
$vendor_id = $vendor['vendor_id'];

// Fetch data
$sql = "SELECT current_stall, relocated_stall, reason, approval_status FROM relocation_req WHERE vendor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendor_id);
$stmt->execute();
$result = $stmt->get_result();

// Display data
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td class='text-center'>" . htmlspecialchars($vendor_id) . "</td>"; // Vendor ID
    echo "<td class='text-center'>" . htmlspecialchars($row['current_stall']) . "</td>"; // Current Stall
    echo "<td class='text-center'>" . htmlspecialchars($row['relocated_stall']) . "</td>"; // Relocated Stall
    echo "<td class='text-center'>" . htmlspecialchars($row['reason']) . "</td>"; // Reason
    echo "<td class='text-center'>" . htmlspecialchars($row['approval_status']) . "</td>"; // Approval Status
    echo "<td class='text-center'>" . htmlspecialchars($row['request_date']) . "</td>"; // Relocation Request Date
    echo "</tr>";
}

// Close connections
$stmt->close();
$conn->close();
?>