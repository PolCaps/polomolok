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


    // Check if the required POST data is set
    if (
        isset($_POST['monthBill']) &&
        isset($_POST['building']) &&
        isset($_POST['name']) &&
        isset($_POST['stallNumber']) &&
        isset($_POST['dueDate']) &&
        isset($_POST['padlockingDate']) &&
        isset($_POST['grandTotal']) &&
        isset($_POST['totalPay']) &&
        isset($_POST['numMonths']) &&
        isset($_POST['penaltyFee'])
    ) {
        // Sanitize input data to avoid security risks
        $monthBill = htmlspecialchars($_POST['monthBill']);
        $buildingName = htmlspecialchars($_POST['building']);
        $username = htmlspecialchars($_POST['name']);
        $stallNumber = htmlspecialchars($_POST['stallNumber']);
        $dueDate = htmlspecialchars($_POST['dueDate']);
        $padlockingDate = htmlspecialchars($_POST['padlockingDate']);
        $grandTotal = htmlspecialchars($_POST['grandTotal']);
        $totalPay = htmlspecialchars($_POST['totalPay']);
        $numMonths = htmlspecialchars($_POST['numMonths']);
        $penaltyFee = htmlspecialchars($_POST['penaltyFee']);

        // Prepare post data with additional fields for the PDF template
        $postData = [
            'template' => [
                'id' => '1240474', // Template ID for your billing notice
                'data' => [
                    'monthBill' => $monthBill,          // Bill for the month of
                    'building' => $buildingName,        // Building name or number
                    'name' => $username,                // Name of the vendor/recipient
                    'stallNumber' => $stallNumber,      // Stall number
                    'due' => date('Y-m-d', strtotime($dueDate)),  // Due date formatted
                    'lock' => $padlockingDate,          // Padlocking date if applicable
                    'grandTotal' => number_format((float) $grandTotal, 2, '.', ''), // Grand total with 2 decimals
                    'total' => number_format((float) $totalPay, 2, '.', ''),       // Total payment with 2 decimals
                    'numberMonth' => $numMonths,        // Number of months
                    'dueFee' => number_format((float) $penaltyFee, 2, '.', ''),    // Penalty fee with 2 decimals
                ]
            ],
            'format' => 'pdf',         // Format the response as a PDF
            'output' => 'url',         // Get the output URL from the response
            'name' => 'NOTICE'         // Name of the generated document
        ];

        // Example of sending the post data via cURL (adjust as needed)
        $url = "https://us1.pdfgeneratorapi.com/api/v4/documents/generate"; // Replace with your actual API URL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        // Execute cURL request and handle the response
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check if the response is successful (you may need to adjust based on your API's response format)
        if ($httpCode == 200) {
            $responseData = json_decode($response, true);
            if (isset($responseData['url'])) {
                // Redirect or display the generated PDF URL
                header('Location: ' . $responseData['url']);
                exit();
            } else {
                echo 'Error: Could not retrieve PDF URL from the response.';
            }
        } else {
            echo 'Error: Failed to generate PDF. HTTP Status Code: ' . $httpCode;
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