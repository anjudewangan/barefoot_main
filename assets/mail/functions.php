<?php

require_once(dirname(__DIR__, 2) . '/includes/connection_inner.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require '../pay_vendor/autoload.php';

use Razorpay\Api\Api;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = $_POST['form_type'];
    $emailformat = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
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
        $mail->CharSet = 'utf-8';

        // Step1 ------- Handle registration form submission
        if ($formType === 'register') {
            if (empty($_POST['name'])) {
                echo json_encode(array("class_name" => 'name', "error" => "Please enter full name"));
                exit;
            } elseif (empty($_POST['age'])) {
                echo json_encode(array("class_name" => 'age', "error" => "Please enter your age"));
                exit;
            } elseif (empty($_POST['email'])) {
                echo json_encode(array("class_name" => 'email', "error" => "Please enter email id"));
                exit;
            } elseif (!preg_match($emailformat, $_POST['email']) && !empty($_POST['email'])) {
                echo json_encode(array("class_name" => 'email', "error" => "Please enter valid email id"));
                exit;
            } elseif (empty($_POST['phone_no'])) {
                echo json_encode(array("class_name" => 'phone_no', "error" => "Please enter phone number"));
                exit;
            } elseif ((strlen($_POST['phone_no']) < 10 || strlen($_POST['phone_no']) > 10) && !empty($_POST['phone_no'])) {
                echo json_encode(array("class_name" => 'phone_no', "error" => "Phone number must be equal to 10 digit"));
                exit;
            } elseif (empty($_POST['gender'])) {
                echo json_encode(array("class_name" => 'gender', "error" => "Please select gender"));
                exit;
            } elseif (empty($_POST['location'])) {
                echo json_encode(array("class_name" => 'location', "error" => "Please enter your location"));
                exit;
            } elseif (empty($_POST['attended_classes'])) {
                echo json_encode(array("class_name" => 'attended_classes', "error" => "Please select attended any self-defense classes before"));
                exit;
            } elseif (empty($_POST['gender'])) {
                echo json_encode(array("class_name" => 'gender', "error" => "Please select how did you hear about us"));
                exit;
            } else {
                echo json_encode(array("class_name" => '', "step" => 2));
                exit;
            }
        }
        // Step2 -------Handle registration form submission
        elseif ($formType === 'payment') {
            if (empty($_POST['course'])) {
                echo json_encode(array("class_name" => 'course', "error" => "Please select your course"));
                exit;
            } elseif (empty($_POST['course_plan'])) {
                echo json_encode(array("class_name" => 'course_plan', "error" => "Please select your course plan"));
                exit;
            } elseif (empty($_POST['payment_method'])) {
                echo json_encode(array("class_name" => 'payment_method', "error" => "Please select payment method"));
                exit;
            } else {

                if ($_POST['payment_method'] == 'online') {

                    //========Demo Key===============================
                    $keyId = 'rzp_test_2SIUZYi7h8eVQY';
                    $keySecret = 'OaC2hNczZGmSLbbdzsJGAK7a';

                    $api = new Api($keyId, $keySecret);

                    // Loop through each POST data and store it in the session
                    foreach ($_POST as $key => $value) {
                        $_SESSION[$key] = $value;
                    }

                    $payprice = ($_POST['course_plan'] - ($_POST['course_plan'] / 10)) * 100;
                    $callbacklink = 'http://localhost/barefoot/payment-callback.php';
                    // $callbacklink = 'https://barefoot.org.in/payment-callback.php';

                    $paymentLink = $api->paymentLink->create(array(
                        'amount' => $payprice,
                        'currency' => 'INR',
                        'description' => $_POST['course'],
                        'customer' => array('email' => $email),
                        'notify' => array('email' => true),
                        'reminder_enable' => true,
                        'callback_url' => $callbacklink,
                        'callback_method' => 'get'
                    ));

                    $link = $paymentLink['short_url'];
                    echo json_encode(array("class_name" => '', "payurl" => $link));
                    exit;
                } else {
                    //----CD Payment and Insert Data for Contact---------
                    $_POST['coursePlan'] = getCoursePlan($_POST['course'], $_POST['course_plan']);
                    $_POST['amount'] = $_POST['course_plan'];
                    $_POST['status'] = 'unpaid';

                    $Q_obj->transaction_Create($_POST);

                    $mail->Subject = 'New Registration Form Submission';

                    $fullName = ucwords(strtolower(trim($_POST['name'])));
                    $age = intval(trim($_POST['age']));
                    $emailAddress = strtolower(trim($_POST['email']));
                    $contactNumber = trim($_POST['phone_no']);
                    $location = ucwords(strtolower(trim($_POST['location'])));
                    $gender = ucwords(strtolower(trim($_POST['gender'])));
                    $attendClass = ucwords(strtolower(trim($_POST['attended_classes'])));
                    $aboutUs = ucwords(strtolower(trim($_POST['hear_about'])));
                    $course = ucwords(strtolower(trim($_POST['course'])));
                    $paymentMethod = ucwords(strtolower(trim($_POST['payment_method'])));
                    $paymentPlan = ucwords(strtolower(trim($_POST['coursePlan'])));

                    $content = file_get_contents(dirname(__FILE__) . '/payment_mail.html');
                    $content = str_replace('%fullName%', $fullName, $content);
                    $content = str_replace('%age%', $age, $content);
                    $content = str_replace('%emailAddress%', $emailAddress, $content);
                    $content = str_replace('%contactNumber%', $contactNumber, $content);
                    $content = str_replace('%location%', $location, $content);
                    $content = str_replace('%gender%', $gender, $content);
                    $content = str_replace('%attendClass%', $attendClass, $content);
                    $content = str_replace('%aboutUs%', $aboutUs, $content);
                    $content = str_replace('%course%', $course, $content);
                    $content = str_replace('%paymentPlan%', $paymentPlan, $content);
                    $content = str_replace('%paymentMethod%', $paymentMethod, $content);
                    $mail->msgHTML($content, __DIR__);

                    if ($mail->send()) {
                        echo json_encode(array("class_name" => '', "step" => 3, "payurl" => '', "msg" => 'Thank you! Your submission has been received!'));
                        exit;
                    } else {
                        echo json_encode(array("class_name" => 'cerror', "error" => "Email not sent."));
                        exit;
                    }
                }
            }
        }
        // Handle contact form submission
        elseif ($formType === 'contact') {
            $name = ucwords(strtolower(trim($_POST['conatct_name'])));
            $email = strtolower(trim($_POST['conatct_email']));
            $message = trim($_POST['conatct_message']);

            if (empty($name)) {

                echo json_encode(array("class_name" => 'conatct_name', "error" => "Please enter name"));
                exit;
            } elseif (empty($email)) {

                echo json_encode(array("class_name" => 'conatct_email', "error" => "Please enter email id"));
                exit;
            } elseif (!preg_match($emailformat, $email) && !empty($email)) {

                echo json_encode(array("class_name" => 'conatct_email', "error" => "Please enter valid email id"));
                exit;
            } elseif (empty($message)) {

                echo json_encode(array("class_name" => 'conatct_message', "error" => "Please write your message"));
                exit;
            } else {

                //----Insert Data for Contact---------
                $Q_obj->contact_Create($_POST);

                $mail->Subject = 'Contact Form Submission';
                $content = file_get_contents(dirname(__FILE__) . '/contact_mail.html');
                $content = str_replace('%name%', $name, $content);
                $content = str_replace('%email%', $email, $content);
                $content = str_replace('%message%', $message, $content);
                $mail->msgHTML($content, __DIR__);

                if ($mail->send()) {
                    echo json_encode(array("class_name" => '', "msg" => 'Thank you! Your submission has been received!'));
                    exit;
                } else {
                    echo json_encode(array("class_name" => 'cerror', "error" => "Email not sent."));
                    exit;
                }
            }
        }
    } catch (Exception $e) {
        echo json_encode(['class_name' => 'cerror', 'error' => 'Mail could not be sent.']);
        exit;
    }
} else {
    echo json_encode(['class_name' => 'cerror', 'error' => 'Invalid request method.']);
    exit;
}
