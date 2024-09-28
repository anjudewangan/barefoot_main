<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = $_POST['form_type'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'barefootraipur@gmail.com'; 
        $mail->Password   = 'achwxqozfxhvghdm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('barefootraipur@gmail.com', 'Barefoot'); 
        $mail->addAddress('barefootraipur@gmail.com');

        if ($formType === 'register') {
            $fullName = ucwords(strtolower($_POST['FullName']));
            $dateOfBirth = $_POST['DateofBirth'];
            $emailAddress = strtolower($_POST['EmailAddress']);
            $contactNumber = $_POST['ContactNumber'];
            $attendClass = ucwords(strtolower($_POST['AttendClass']));
            $aboutUs = ucwords(strtolower($_POST['AboutUs']));

            $mail->Subject = 'New Registration Form Submission';
            $mail->isHTML(true);
            $mail->Body = "
                <html>
                <head>
                    <title>Registration Form Submission</title>
                </head>
                <body>
                    <h2>Registration Details</h2>
                    <p><strong>Full Name:</strong> $fullName</p>
                    <p><strong>Date of Birth:</strong> $dateOfBirth</p>
                    <p><strong>Email Address:</strong> $emailAddress</p>
                    <p><strong>Contact Number:</strong> $contactNumber</p>
                    <p><strong>Have you attended any self-defense classes before?:</strong> $attendClass</p>
                    <p><strong>How did you hear about us?:</strong> $aboutUs</p>
                </body>
                </html>
            ";

        } elseif ($formType === 'contact') {
            $fullName = ucwords(strtolower($_POST['FullName-2']));
            $emailAddress = strtolower($_POST['EmailAddress-2']);
            $message = $_POST['Message'];

            $mail->Subject = 'Contact Form Submission';
            $mail->isHTML(true);
            $mail->Body = "
                <html>
                <head>
                    <title>Contact Form Submission</title>
                </head>
                <body>
                    <h2>Contact Form Details</h2>
                    <p><strong>Full Name:</strong> $fullName</p>
                    <p><strong>Email Address:</strong> $emailAddress</p>
                    <p><strong>Message:</strong> $message</p>
                </body>
                </html>
            ";
        }

        if ($mail->send()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Email not sent.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Mail could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
