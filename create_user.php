<?php
    // Include database configuration
    include('database_config.php');
    header('Content-Type: application/json');
    
    // Connect to the database
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
        exit;
    }
    // echo json_encode(['postData' => $_POST]);
    // Retrieve form data
    $usertype = $_POST['usertype'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $age = $_POST['age'];
    $contactNumber = $_POST['contact_number']; 
    $address = $_POST['address'];
    $storeNumber = $_POST['store_number'];
    $buildingType = $_POST['building_type'];
    $startDate = $_POST['started_date'];
    $endDate = $_POST['end_date']; 
    $monthlyPayment = $_POST['monthly_payment'];
    $leaseAgreement = $_POST['lease_agreements'];
    $businessPermit = $_POST['business_permits'];
    $supportingDocu = $_POST['supporting_docu'];

    // $requiredFields = [
    //     'usertype', 'username', 'password', 'first_name', 'middle_name', 
    //     'last_name', 'age', 'contact_number', 'address', 'store_number', 
    //     'building_type', 'started_date', 'end_date', 'monthly_payment', 
    //     'lease_agreements', 'business_permits', 'supporting_docu'
    // ];

    if (empty($usertype) || empty($username) || empty($password) || 
    empty($firstName) || empty($middleName) || empty($lastName) || empty($age) || 
    empty($contactNumber) || empty($address) || empty($storeNumber) || empty($buildingType) || 
    empty($startDate) || empty($endDate) || empty($monthlyPayment) || empty($leaseAgreement) || 
    empty($businessPermit) || empty($supportingDocu)) {
        echo json_encode(['success' => false, 'error' => 'Unable to connect.']);
        exit;
    }
    $conn = new mysqli($db_host,$db_user, $db_password , $db_name);

    if ($conn->connect_error) {
        ECHO json_encode(['success' => false, 'error' => 'Connection Failed']);  
        exit; 
    }
    $sql = "INSERT INTO users_account (
        user_type, 
        username, 
        password, 
        first_name, 
        middle_name, 
        last_name, 
        age, 
        contact_number, 
        address, 
        store_number, 
        building_type, 
        started_date, 
        end_date, 
        monthly_payment, 
        lease_agreements, 
        business_permits, 
        supporting_docu
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    // $conn->query($sql);
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Failed to prepare statement: ' . $conn->error]);
        exit;
    }
    // Bind values to the prepared statement (important for security)
    $stmt->bind_param('ssssssiisisssisss', 
    $usertype, $username, $password, $firstName, $middleName, $lastName, 
    $age, $contactNumber, $address, $storeNumber, $buildingType, $startDate, $endDate, 
    $monthlyPayment, $leaseAgreement, $businessPermit, $supportingDocu);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to create user.'. $stmt->error]);
    }
    // Close the statement (after execution)
    $stmt->close();
    $conn->close(); 
?>
