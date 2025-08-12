<?php
// Start the session
session_start();

// Include the connection.php file
require("connection.php");

/// Get data from payment.php
$user_id = isset($_POST['user_id']) ? filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT) : '';
$eventId = isset($_POST['event_id']) ? filter_var($_POST['event_id'], FILTER_SANITIZE_NUMBER_INT) : '';
$eventName = isset($_POST['event_name']) ? filter_var($_POST['event_name'], FILTER_SANITIZE_STRING) : '';
$clientName = isset($_POST['client_name']) ? filter_var($_POST['client_name'], FILTER_SANITIZE_STRING) : '';
$clientEmail = isset($_POST['client_email']) ? filter_var($_POST['client_email'], FILTER_SANITIZE_EMAIL) : '';
$eventDate = isset($_POST['event_date']) ? filter_var($_POST['event_date'], FILTER_SANITIZE_STRING) : '';
$eventStartingTime = isset($_POST['event_starting_time']) ? filter_var($_POST['event_starting_time'], FILTER_SANITIZE_STRING) : '';
$eventEndingTime = isset($_POST['event_ending_time']) ? filter_var($_POST['event_ending_time'], FILTER_SANITIZE_STRING) : '';
$venueAddress = isset($_POST['venue_address']) ? filter_var($_POST['venue_address'], FILTER_SANITIZE_STRING) : '';
$additionalInformation = isset($_POST['additional_information']) ? filter_var($_POST['additional_information'], FILTER_SANITIZE_STRING) : '';
$bookingDate = isset($_POST['booking_date']) ? filter_var($_POST['booking_date'], FILTER_SANITIZE_STRING) : '';
$status = isset($_POST['status']) ? filter_var($_POST['status'], FILTER_SANITIZE_STRING) : '';
$price = isset($_POST['price']) ? filter_var($_POST['price'], FILTER_SANITIZE_STRING) : '';
$paymentstatus = isset($_POST['payment_status']) ? filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING) : '';

// Display data
echo "user_id: " . $user_id . "<br>";
echo "Event ID: " . $eventId . "<br>";
echo "Event Name: " . $eventName . "<br>";
echo "Client Name: " . $clientName . "<br>";
echo "Client Email: " . $clientEmail . "<br>";
echo "Event Date: " . $eventDate . "<br>";
echo "Event Starting Time: " . $eventStartingTime . "<br>";
echo "Event Ending Time: " . $eventEndingTime . "<br>";
echo "Venue Address: " . $venueAddress . "<br>";
echo "Additional Information: " . $additionalInformation . "<br>";
echo "Booking Date: " . $bookingDate . "<br>";
echo "Status: " . $status . "<br>";
echo "Price: " . $price . "<br>";
echo "payment_status: " . $paymentstatus . "<br>";

// Payment Options

    // Calculate total price

    
    // Display checkout message
    echo '<div class="alert alert-success">Thank you for your purchase! Your total is $' . $price . '.</div>';

    // Display payment options
    echo '<h2>Payment Options:</h2>';
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
    echo '<input type="radio" name="payment_method" value="credit_card"> Credit Card<br>';
    echo '<input type="radio" name="payment_method" value="Gpay"> Google Pay<br>';
    echo '<input type="radio" name="payment_method" value="bank_transfer"> Bank Transfer<br>';
    echo '<button type="submit" name="submit" class="btn btn-primary">Pay</button>';
    echo '</form>';
    echo  "$eventId";


// Process Payment
// Process Payment
if (isset($_POST['submit'])) {
    $paymentMethod = $_POST['payment_method'];

    // Connect to MongoDB
    require("connection.php");

    // Update payment status field in cart_event collection
    if (!empty($eventId)) {
     
        $filter = ['event_id' => new MongoDB\BSON\ObjectId($eventId)];
        $update = ['$set' => ['payment_status' => 'Payment Done']];
        $options = ['upsert' => true];
        $result = $collection->updateOne($filter, $update, $options);
    } else {
        echo 'Error: Event ID is empty.';
    }

    // Display success message and redirect to cart_event.php
    echo '<script>alert("Payment successful! Your booking has been confirmed."); window.location.href="cart_event.php";</script>';
}
?>