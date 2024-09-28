<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = $_POST['Course'];
    $paymentMethod = $_POST['PaymentMethod'];


    echo "<h2>Thank you!</h2>";
    echo "<p>You have selected the <strong>$course</strong> course.</p>";
    echo "<p>Your preferred payment method is: <strong>$paymentMethod</strong>.</p>";
} else {
    echo 'Invalid request method.';
}
