<?php
    // Include database configuration
    //include('database_config.php');

    // Connect to the database
    session_start();
    $conn = new mysqli('localhost','root', 'PolomolokPublicMarket');
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    
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
    $leaseAgreement = $_POST['lease_agreement'];
    $businessPermit = $_POST['business_permit'];
    $supportingDocu = $_POST['supporting_docu'];

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
        lease_agreement, 
        business_permit, 
        supporting_docu
    ) VALUES ($usertype, $username, $password, $firstName, $middleName, $lastName, $age, $contactNumber, $address, $storeNumber, $buildingType, $startDate, $endDate, $monthlyPayment, $leaseAgreement, $businessPermit, $supportingDocu)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }


    // Bind values to the prepared statement (important for security)
    $stmt->bind_param("
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
        lease_agreement, 
        business_permit, 
        supporting_docu"
    , 
    $usertype, $username, $password, $firstName, $middleName, $lastName, 
    $age, $contactNumber, $address, $storeNumber, $buildingType, $startDate, $endDate, 
    $monthlyPayment, $leaseAgreement, $businessPermit, $supportingDocu);


    // Execute the prepared statement
    if (!$stmt->execute()) {
        die("Failed to execute statement: " . $stmt->error);
    }


  // Close the statement (after execution)
    $stmt->close();


  $conn->close();

?>
