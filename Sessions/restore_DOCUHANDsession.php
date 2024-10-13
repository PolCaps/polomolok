<?php
// Include database configuration
include('database_config.php');

// Get the JSON data from the request body
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

// Start the session
session_name('admin_session');
session_start();

$response = ['success' => false];

if (isset($data['session_id'])) {
    session_id($data['session_id']);
    session_start();

    // Check if the session is still valid and the user is logged in
    if (isset($_SESSION['id']) && $_SESSION['user_type'] === 'ADMIN') {
        $response['success'] = true;
    }
}

// Send the JSON response back to the client
header('Content-Type: application/json');
echo json_encode($response);
?>
