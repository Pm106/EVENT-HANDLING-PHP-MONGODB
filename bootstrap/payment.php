<?php
session_start();
require("connection.php");

if (isset($_POST['event_id'])) {
    $user_id = $_POST['user_id'];
    $eventId = $_POST['event_id'];
    $eventName = $_POST['event_name'];
    $clientName = $_POST['client_name'];
    $clientEmail = $_POST['client_email'];
    $eventDate = $_POST['event_date'];
    $eventStartingTime = $_POST['event_starting_time'];
    $eventEndingTime = $_POST['event_ending_time'];
    $venueAddress = $_POST['venue_address'];
    $additionalInformation = $_POST['additional_information'];
    $bookingDate = $_POST['booking_date'];
    $status = $_POST['status'];
    $price = $_POST['price']; 
    $paymentstatus = $_POST['payment_status'];    
    ?>
    <html>
    <head>
        <title>Payment Terms and Conditions</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Payment Terms and Conditions</h2>
                    <p>Please read the following terms and conditions carefully before proceeding with the payment.</p>
                    <ul>
                        <li>All payments are non-refundable.</li>
                        <li>Payment must be made in full at the time of booking.</li>
                        <li>We accept all major credit cards and PayPal.</li>
                        <li>By making a payment, you agree to our terms and conditions.</li>
                        <li>If you cancel the event, the following cancellation fees will apply:</li>
                        <li>30% of the total payment will be non-refundable if the event is cancelled more than 30 days prior to the event date.</li>
                        <li>50% of the total payment will be non-refundable if the event is cancelled between 15-30 days prior to the event date.</li>
                        <li>100% of the total payment will be non-refundable if the event is cancelled less than 15 days prior to the event date.</li>
                    </ul>
                    <form action="payment-processing.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
                        <input type="hidden" name="event_name" value="<?php echo $eventName; ?>">
                        <input type="hidden" name="client_name" value="<?php echo $clientName; ?>">
                        <input type="hidden" name="client_email" value="<?php echo $clientEmail; ?>">
                        <input type="hidden" name="event_date" value="<?php echo $eventDate; ?>">
                        <input type="hidden" name="event_starting_time" value="<?php echo $eventStartingTime; ?>">
                        <input type="hidden" name="event_ending_time" value="<?php echo $eventEndingTime; ?>">
                        <input type="hidden" name="venue_address" value="<?php echo $venueAddress; ?>">
                        <input type="hidden" name="additional_information" value="<?php echo $additionalInformation; ?>">
                        <input type="hidden" name="booking_date" value="<?php echo $bookingDate; ?>">
                        <input type="hidden" name="status" value="<?php echo $status; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="payment_status" value="<?php echo $paymentstatus; ?>">                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="terms-and-conditions" required>
                            <label class="form-check-label" for="terms-and-conditions">
                                I have read and agree to the terms and conditions.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Invalid request.";
}
?>
