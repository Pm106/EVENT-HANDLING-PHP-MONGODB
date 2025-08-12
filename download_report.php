<?php
// Get the data from the query string
if (isset($_GET['_id'])) {
    $_id = $_GET['_id'];
} else {
    $_id = '';
}

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    $event_id = '';
}

if (isset($_GET['client_name'])) {
    $event_name = $_GET['client_name'];
} else {
    $event_name = '';
}

if (isset($_GET['price'])) {
    $price = $_GET['price'];
} else {
    $price = '';
}

if (isset($_GET['payment_method'])) {
    $payment_method = $_GET['payment_method'];
} else {
    $payment_method = '';
}

if (isset($_GET['payment_date'])) {
    $payment_date = $_GET['payment_date'];
} else {
    $payment_date = '';
}

// Create a CSV file
$fp = fopen('report.csv', 'w');

// Write the header row
fputcsv($fp, array('Report ID', 'Event ID', 'client_name', 'Price', 'Payment Method', 'Order Date'));

// Write the data row
fputcsv($fp, array($_id, $event_id, $client_name, $price, $payment_method, $payment_date));

// Close the file
fclose($fp);

// Download the file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="report.csv"');
readfile('report.csv');
?>