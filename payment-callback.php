<?php
require("includes/connection_inner.php");
require('assets/pay_vendor/autoload.php');
require('assets/mail/vendor/autoload.php');

use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;

//========Demo Key===============================
$keyId = 'rzp_test_2SIUZYi7h8eVQY';
$keySecret = 'OaC2hNczZGmSLbbdzsJGAK7a';

$api = new Api($keyId, $keySecret);

$paymentId = $_REQUEST['razorpay_payment_id'];


try {
    $payment = $api->payment->fetch($paymentId);

    $amount = $payment->amount / 100;

    //----Transaction Create---------
    $_SESSION['coursePlan'] = getCoursePlan($_SESSION['course'], $_SESSION['course_plan']);
    $_SESSION['payment_method'] = 'Online Payment (Get 10% discount)';
    $_SESSION["payment_id"] = $payment->id;
    $_SESSION["order_id"] = $payment->order_id;
    $_SESSION["amount"] = $amount;
    $_SESSION["status"] = $payment->status;

    $Q_obj->transaction_Create($_SESSION);

    if ($payment->status == 'captured') {

        //----------Mail Send Detail---------------------------------------------------
        $mail = new PHPMailer(true);
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

        $mail->Subject = 'New Registration Form Submission';

        $content = file_get_contents(dirname(__FILE__) . '/assets/mail/payment_mail.html');
        $content = str_replace('%fullName%', $_SESSION['name'], $content);
        $content = str_replace('%age%', $_SESSION['age'], $content);
        $content = str_replace('%emailAddress%', $_SESSION['email'], $content);
        $content = str_replace('%contactNumber%', $_SESSION['phone_no'], $content);
        $content = str_replace('%location%', $_SESSION['location'], $content);
        $content = str_replace('%gender%', $_SESSION['gender'], $content);
        $content = str_replace('%attendClass%', $_SESSION['attended_classes'], $content);
        $content = str_replace('%aboutUs%', $_SESSION['hear_about'], $content);
        $content = str_replace('%course%', $_SESSION['course'], $content);
        $content = str_replace('%paymentPlan%', $_SESSION['coursePlan'], $content);
        $content = str_replace('%paymentMethod%', $_SESSION['payment_method'], $content);
        $mail->msgHTML($content, __DIR__);
        $mail->send();
        $mail->clearAddresses();
        $mail->smtpClose();
        //----------End Mail Detail----------------------------------------------------
        $_SESSION = array();
        session_destroy();
        header("Location: ./success-payment.html");
    } else {
        header("Location: ./failed-payment.html");
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
