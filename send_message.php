<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decode the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    $vendorName = $input['vendor_name'];
    $message = $input['message'];

    // Validate input data
    if (!isset($vendorName) || !isset($message)) {
        echo json_encode(['success' => false, 'error' => 'Missing vendor name or message']);
        exit;
    }

    // Include database configuration
    include('database_config.php');

    // Create a connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'error' => $conn->connect_error]);
        exit;
    }

    // Fetch recipient number from the database
    $stmt = $conn->prepare('SELECT contact_no AS recipient FROM vendors WHERE username = ?');
    $stmt->bind_param('s', $vendorName);
    $stmt->execute();
    $result = $stmt->get_result();
    $vendor = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if (!$vendor) {
        echo json_encode(['success' => false, 'error' => 'Recipient not found']);
        exit;
    }

    // Prepare the message to be sent
    $infobipData = [
        'messages' => [
            [
                'destinations' => [['to' => $vendor['recipient']]],
                'from' => 'MEEDO Polomolok',
                'text' => "Message: $message\nThis is from MEEDO,\nYou have to pay your outstanding balances"
            ]
        ]
    ];

    // Convert to JSON
    $raw = json_encode($infobipData);

    // Set up headers
    $headers = [
        'Authorization: App d45463d7941bec1c5d5c855242aa1689-1e7845e7-4025-47ba-88d2-19aeef67de3a',
        'Content-Type: application/json',
        'Accept: application/json'
    ];

    // Using HTTP_Request2 to send request
    require_once 'HTTP/Request2.php';
    $request = new HTTP_Request2();
    $request->setUrl('https://6gxw8e.api.infobip.com/sms/2/text/advanced');
    $request->setMethod(HTTP_Request2::METHOD_POST);
    $request->setConfig(array(
        'follow_redirects' => TRUE
    ));
    $request->setHeader($headers);
    $request->setBody($raw);

    try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            echo json_encode(['success' => true, 'response' => $response->getBody()]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Unexpected HTTP status: ' . $response->getStatus() . ' ' . $response->getReasonPhrase()]);
        }
    } catch (HTTP_Request2_Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
    }
}
?>
