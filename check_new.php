<?php
include('database_config.php');

// Start the session
session_start();

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array('newEntry' => false, 'newEntries' => array());

// Check the latest entry in the relocation_req table
$sql1 = "SELECT * FROM relocation_req ORDER BY request_id DESC LIMIT 1";
$result1 = $conn->query($sql1);
if ($result1 === false) {
    // SQL error handling
    $response['error'] = "Error executing query: " . $conn->error;
} else {
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        if (!isset($_SESSION['last_entry_id']) || $_SESSION['last_entry_id'] != $row['request_id']) {
            $_SESSION['last_entry_id'] = $row['request_id'];
            $response['newEntries']['New Relocation Request'] = true;
            $response['newEntry'] = true;
        }
    }
}

// Check the latest entry in the rent_application table
$sql2 = "SELECT * FROM rent_application ORDER BY applicant_id DESC LIMIT 1";
$result2 = $conn->query($sql2);
if ($result2 === false) {
    // SQL error handling
    $response['error'] = "Error executing query: " . $conn->error;
} else {
    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        if (!isset($_SESSION['last_application_id']) || $_SESSION['last_application_id'] != $row['applicant_id']) {
            $_SESSION['last_application_id'] = $row['applicant_id'];
            $response['newEntries']['New Rental Application'] = true;
            $response['newEntry'] = true;
        }
    }
}

// Check the latest entry in the documents table
$sql3 = "SELECT * FROM documents ORDER BY document_id DESC LIMIT 1";
$result3 = $conn->query($sql3);
if ($result3 === false) {
    // SQL error handling
    $response['error'] = "Error executing query: " . $conn->error;
} else {
    if ($result3->num_rows > 0) {
        $row = $result3->fetch_assoc();
        if (!isset($_SESSION['last_document_id']) || $_SESSION['last_document_id'] != $row['document_id']) {
            $_SESSION['last_document_id'] = $row['document_id'];
            $response['newEntries']['New Documents'] = true;
            $response['newEntry'] = true;
        }
    }
}

// Check the latest entry in the vendorsoa table
$sql4 = "SELECT * FROM vendorsoa ORDER BY id DESC LIMIT 1";
$result4 = $conn->query($sql4);
if ($result4 === false) {
    // SQL error handling
    $response['error'] = "Error executing query: " . $conn->error;
} else {
    if ($result4->num_rows > 0) {
        $row = $result4->fetch_assoc();
        if (!isset($_SESSION['last_soa_id']) || $_SESSION['last_soa_id'] != $row['id']) {
            $_SESSION['last_soa_id'] = $row['id'];
            $response['newEntries']['New Statement of Accounts'] = true;
            $response['newEntry'] = true;
        }
    }
}

// Check the latest entry in the inquiry table
$sql5 = "SELECT * FROM inquiry ORDER BY inq_id DESC LIMIT 1";
$result5 = $conn->query($sql5);
if ($result5 === false) {
    // SQL error handling
    $response['error'] = "Error executing query: " . $conn->error;
} else {
    if ($result5->num_rows > 0) {
        $row = $result5->fetch_assoc();
        if (!isset($_SESSION['last_inquiry_id']) || $_SESSION['last_inquiry_id'] != $row['inq_id']) {
            $_SESSION['last_inquiry_id'] = $row['inq_id'];
            $response['newEntries']['New Inquiries'] = true;
            $response['newEntry'] = true;
        }
    }
}

// Check the latest entry in the receipts table
$sql6 = "SELECT * FROM receipts ORDER BY receipt_id DESC LIMIT 1";
$result6 = $conn->query($sql6);
if ($result6 === false) {
    // SQL error handling
    $response['error'] = "Error executing query: " . $conn->error;
} else {
    if ($result6->num_rows > 0) {
        $row = $result6->fetch_assoc();
        if (!isset($_SESSION['last_receipt_id']) || $_SESSION['last_receipt_id'] != $row['receipt_id']) {
            $_SESSION['last_receipt_id'] = $row['receipt_id'];
            $response['newEntries']['New Receipt'] = true;
            $response['newEntry'] = true;
        }
    }
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json'); // Set content type for JSON response
echo json_encode($response);
?>
