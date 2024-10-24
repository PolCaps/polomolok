<?php

session_start();

date_default_timezone_set('Asia/Manila'); 

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('database_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicant_id = $_POST['applicant_id'];
    $status = $_POST['status'];
    $email = $_POST['email']; // Retrieve the email address from the form
    $email_message = $_POST['email_message']; // Retrieve the email message from the form

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE rent_application SET Approval = ? WHERE applicant_id = ?");
    $stmt->bind_param("si", $status, $applicant_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'polomolokpublicmarket@gmail.com'; 
            $mail->Password = 'tsgxftoeulzixxyv'; // Use environment variables or a more secure method in production
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('polomolokpublicmarket@gmail.com', 'Polomolok Public Market');
            $mail->addAddress($email); 

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Update on Your Rent Application (ID: $applicant_id)";
            $mail->Body = nl2br(htmlspecialchars($email_message)); // Format the email body

            // Send the email
            $mail->send();

            if ($status === 'APPROVED') {
                $notification_type = 'Ready for payment';
                $notification_message = "New Approved Rent Application";
                $time_stamp = date('Y-m-d H:i:s'); 
                $is_read = 0;

                // Insert notification for Admin
                $stmt_admin = $conn->prepare("INSERT INTO notifications (user_type, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");
                $user_type = 'Cashier';

                if ($stmt_admin) {
                    $stmt_admin->bind_param("ssssi", $user_type, $notification_type, $notification_message, $time_stamp, $is_read);
                    $stmt_admin->execute();
                    $stmt_admin->close();
                }
            }

            header("Location: ../AMStallApp.php");
            exit();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        header("Location: ../AMStallApp.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
