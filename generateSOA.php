<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database configuration
    include('database_config.php');

    // Create a connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    // API Key and other constants
    $apiKey = 'sk_2akVMMzyVTB5wlYV8Bjli2lWg1od59Ac';
    $from = "MEEDO / POLOMOLOK PUBLIC MARKET";
    $logo = "image/picmeedo.jpg";
    $date = date("Y-m-d"); // Current date
    $remainingBalance = floatval(str_replace(',', '', $_POST['remaining-balance'])); // Convert to float
    $miscellaneousFees = floatval(str_replace(',', '', $_POST['miscellaneous-fees'])) ?: 0; // Convert to float
    $otherFees = floatval(str_replace(',', '', $_POST['other-fees'])) ?: 0; // Convert to float
    $vendorId = $_POST['vendor-id']; // Use the vendor ID from the form

    // Initialize monthly rent to 0
    $monthly_rent = 0;
    $username = ''; // Initialize username

    // Fetch monthly rentals and username from various tables
    $tables = ['building_a', 'building_b', 'building_c', 'building_d', 'building_e', 'building_f', 'building_g', 'building_h', 'building_i', 'building_j'];

    // First fetch the username and concatenate the name fields
    $sqlVendor = "SELECT username, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS name FROM vendors WHERE vendor_id = ?";
    $stmtVendor = $conn->prepare($sqlVendor);
    $stmtVendor->bind_param("i", $vendorId);
    $stmtVendor->execute();
    $resultVendor = $stmtVendor->get_result();

    if ($resultVendor->num_rows > 0) {
        $rowVendor = $resultVendor->fetch_assoc();
        $username = $rowVendor['username'];
        $name = $rowVendor['name'];
    } else {
        echo json_encode(['success' => false, 'message' => 'Vendor not found']);
        exit;
    }

    $stmtVendor->close();


    // Fetch monthly rentals
    foreach ($tables as $table) {
        $sql = "SELECT monthly_rentals FROM $table WHERE vendor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $vendorId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $monthly_rent = floatval(str_replace(',', '', $row['monthly_rentals'])); // Convert to float
            break; // Stop searching once we find the value
        }
    }

    // Close the statement
    $stmt->close();

    // Sanitize the username for filename
    $sanitizedUsername = preg_replace('/[^a-zA-Z0-9-_]/', '_', $username);

    // Create the file path including the username and date
    $filePath = 'invoice/invoice_' . $sanitizedUsername . '_' . $date . '.pdf';

    // Prepare the data for the statement of accounts
    $data = array(
        "from" => $from,
        "to" => $name, // Use the fetched username
        "logo" => $logo,
        "number" => 1,
        "date" => $date,
        "custom_fields[0][name]" => "Remaining Balance",
        "custom_fields[0][value]" => $remainingBalance,
        "items[0][name]" => "Monthly Rental",
        "items[0][quantity]" => 1,
        "items[0][unit_cost]" => $monthly_rent,
        "items[1][name]" => "Miscellaneous Fee",
        "items[1][quantity]" => 1,
        "items[1][unit_cost]" => $miscellaneousFees,
        "items[2][name]" => "Other Fee",
        "items[2][quantity]" => 1,
        "items[2][unit_cost]" => $otherFees,
        "total" => $monthly_rent + $miscellaneousFees + $otherFees + $remainingBalance // Compute total
    );

    // Initialize cURL session
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://invoice-generator.com");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $apiKey"
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo json_encode(['success' => false, 'message' => 'cURL Error: ' . curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    // Ensure directory exists
    if (!is_dir('invoice')) {
        if (!mkdir('invoice', 0777, true)) {
            echo json_encode(['success' => false, 'message' => 'Failed to create PDF directory']);
            curl_close($ch);
            exit;
        }
    }

    // Save the response to the /invoice folder
    if (file_put_contents($filePath, $response)) {
        // Check if the vendor ID already exists in the vendorSOA table
        $sqlCheck = "SELECT id FROM vendorsoa WHERE vendor_id = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $vendorId);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            // Vendor ID exists, so update the record
            $sqlUpdate = "UPDATE vendorsoa SET username = ?, remaining_balance = ?, monthly_rentals = ?, miscellaneous_fees = ?, other_fees = ?, total_amount = ?, date = ?, file_path = ? WHERE vendor_id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $totalAmount = $monthly_rent + $miscellaneousFees + $otherFees + $remainingBalance;
            $stmtUpdate->bind_param("ssssssssi", $username, $remainingBalance, $monthly_rent, $miscellaneousFees, $otherFees, $totalAmount, $date, $filePath, $vendorId);

            if ($stmtUpdate->execute()) {
                echo json_encode(['success' => true, 'message' => 'Statement of Account updated successfully!', 'file' => $filePath]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update statement in database: ' . $stmtUpdate->error]);
            }

            $stmtUpdate->close();
        } else {
            // Vendor ID does not exist, so insert a new record
            $sqlInsert = "INSERT INTO vendorsoa (vendor_id, username, remaining_balance, monthly_rentals, miscellaneous_fees, other_fees, total_amount, date, file_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $totalAmount = $monthly_rent + $miscellaneousFees + $otherFees + $remainingBalance;
            $stmtInsert->bind_param("issssssss", $vendorId, $username, $remainingBalance, $monthly_rent, $miscellaneousFees, $otherFees, $totalAmount, $date, $filePath);

            if ($stmtInsert->execute()) {
                echo json_encode(['success' => true, 'message' => 'Statement of Account generated successfully!', 'file' => $filePath]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert statement into database: ' . $stmtInsert->error]);
            }

            $stmtInsert->close();
        }

        $stmtCheck->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save the PDF']);
    }

    // Close cURL session
    curl_close($ch);

    // Close database connection
    $conn->close();
}
?>