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

        // Handle registration form submission
        if ($formType === 'register') {
            $fullName = ucwords(strtolower(trim($_POST['FullName'])));
            $age = intval(trim($_POST['Age']));
            $emailAddress = strtolower(trim($_POST['EmailAddress']));
            $contactNumber = trim($_POST['ContactNumber']);
            $location = ucwords(strtolower(trim($_POST['Location'])));
            $gender = ucwords(strtolower(trim($_POST['Gender'])));
            $attendClass = ucwords(strtolower(trim($_POST['AttendClass'])));
            $aboutUs = ucwords(strtolower(trim($_POST['AboutUs'])));
            $course = ucwords(strtolower(trim($_POST['Course'])));
            $paymentMethod = ucwords(strtolower(trim($_POST['PaymentMethod'])));
            $paymentPlan = ucwords(strtolower(trim($_POST['PaymentPlan'])));

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
                    <p><strong>Age:</strong> $age</p>
                    <p><strong>Email Address:</strong> $emailAddress</p>
                    <p><strong>Contact Number:</strong> $contactNumber</p>
                    <p><strong>Location:</strong> $location</p>
                    <p><strong>Gender:</strong> $gender</p>
                    <p><strong>Have you attended any self-defense classes before?:</strong> $attendClass</p>
                    <p><strong>How did you hear about us?:</strong> $aboutUs</p>
                      <p><strong>Your Course:</strong> $course</p>
                    <p><strong>Preferred Payment Method:</strong> $paymentMethod</p>
                    <p><strong>Payment Plan:</strong> $paymentPlan</p>
                </body>
                </html>
            ";
        }
        // Handle contact form submission
        elseif ($formType === 'contact') {
            $fullName = ucwords(strtolower(trim($_POST['FullName-2'])));
            $emailAddress = strtolower(trim($_POST['EmailAddress-2']));
            $message = trim($_POST['Message']);

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
        // Log the error instead of displaying it
        error_log('Mail could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode(['status' => 'error', 'message' => 'Mail could not be sent.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
