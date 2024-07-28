<?php
header('Content-Type: application/json');
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

$conn->autocommit(FALSE);

try {
    // Fetch applicant_ids of rejected applicants
    $sql = "SELECT applicant_id FROM rent_application WHERE Approval = 'DECLINED'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $applicant_id = $row['applicant_id'];
            
            // Delete related records in other tables
            $deleteRelatedSql = "DELETE FROM rentapp_payment WHERE applicant_id = ?";
            $stmt = $conn->prepare($deleteRelatedSql);
            $stmt->bind_param("s", $applicant_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Delete rejected applicants from rent_applications
    $sql = "DELETE FROM rent_application WHERE Approval = 'DECLINED'";
    if ($conn->query($sql) === TRUE) {
        $conn->commit();
        echo json_encode(['success' => true, 'message' => "Rejected applicants deleted successfully."]);
    } else {
        throw new Exception("Error deleting rejected applicants: " . $conn->error);
    }
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>