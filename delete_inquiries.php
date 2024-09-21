<?php
// delete_inquiries.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON body from the request
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['ids']) && is_array($data['ids'])) {
        $ids = $data['ids'];

        include 'database_config.php'; // Include the database connection

        // Create a new MySQLi connection
        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die(json_encode(['success' => false, 'message' => 'Database connection error.']));
        }

        // Convert array of IDs to a comma-separated string
        $idList = implode(',', array_map('intval', $ids));

        // Prepare the DELETE query
        $sql = "DELETE FROM inquiry WHERE inquiry_id IN ($idList)";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting records.']);
        }

        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request data.']);
    }
}
?>
