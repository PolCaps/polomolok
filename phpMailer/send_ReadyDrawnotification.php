<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Include database connection
include 'database_config.php'; // Ensure you include your database connection settings

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Check if the necessary data is present
if (isset($data['email']) && isset($data['message'])) {
    $emailAddress = $data['email'];
    $replyMessage = $data['message'];

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'polomolokpublicmarket@gmail.com'; 
        $mail->Password = 'tsgxftoeulzixxyv'; // Use an app password instead of your Gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('polomolokpublicmarket@gmail.com', 'Polomolok Public Market');
        $mail->addAddress($emailAddress); 

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Congratulations!';
        $mail->Body    = nl2br(htmlspecialchars($replyMessage)); // Handle line breaks

        // Send the email
        $mail->send();

        echo json_encode(['success' => true, 'message' => 'Applicant is notified.']);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

// Close the database connection if it was opened
if (isset($conn) && $conn) {
    $conn->close();
}
?>