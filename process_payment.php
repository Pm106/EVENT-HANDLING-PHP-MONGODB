<?php
// Start the session to retrieve the payment details
session_start();

// Get the payment details from the session
$event_name = $_SESSION['event_name'];
$price = $_SESSION['price'];
$payment_method = $_SESSION['payment_method'];

// Check the payment method and retrieve the corresponding data
if ($payment_method === 'google_pay') {
    $google_pay_email = $_SESSION['google_pay_email'];
    $google_pay_password = $_SESSION['google_pay_password'];
    echo 'Google Pay Email: ' . $google_pay_email;
    echo 'Google Pay Password: ' . $google_pay_password;
} elseif ($payment_method === 'credit_card') {
    $credit_card_number = $_SESSION['credit_card_number'];
    $credit_card_expiration = $_SESSION['credit_card_expiration'];
    $credit_card_cvv = $_SESSION['credit_card_cvv'];
    echo 'Credit Card Number: ' . $credit_card_number;
    echo 'Credit Card Expiration: ' . $credit_card_expiration;
    echo 'Credit Card CVV: ' . $credit_card_cvv;
} elseif ($payment_method === 'debit_card') {
    $debit_card_number = $_SESSION['debit_card_number'];
    $debit_card_expiration = $_SESSION['debit_card_expiration'];
    $debit_card_cvv = $_SESSION['debit_card_cvv'];
    echo 'Debit Card Number: ' . $debit_card_number;
    echo 'Debit Card Expiration: ' . $debit_card_expiration;
    echo 'Debit Card CVV: ' . $debit_card_cvv;
} elseif ($payment_method === 'bank_transfer') {
    $bank_transfer_account_number = $_SESSION['bank_transfer_account_number'];
    $bank_transfer_routing_number = $_SESSION['bank_transfer_routing_number'];
    echo 'Bank Transfer Account Number: ' . $bank_transfer_account_number;
    echo 'Bank Transfer Routing Number: ' . $bank_transfer_routing_number;
}

// Process the payment based on the payment method
if ($payment_method === 'google_pay') {
    // Process the Google Pay payment
    // ...
} elseif ($payment_method === 'credit_card') {
    // Process the credit card payment
    // ...
} elseif ($payment_method === 'debit_card') {
    // Process the debit card payment
    // ...
} elseif ($payment_method === 'bank_transfer') {
    // Process the bank transfer payment
    // ...
}

// Update the database with the payment details
// ...

// Redirect the user to a success page
header('Location: payment_success.php');
exit;
?>