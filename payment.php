<?php
// Start the session
session_start();

// Check if the form has been submitted
if (isset($_POST['process_payment'])) {
    // Get the payment method and details
    $payment_method = $_POST['payment_method'];
    $event_name = $_POST['event_name'];
    $price = $_POST['price'];

    // Process the payment based on the payment method
    if ($payment_method == 'google_pay') {
        // Process Google Pay payment
        processGooglePayPayment($event_name, $price);
    } elseif ($payment_method == 'credit_card') {
        // Process Credit Card payment
        processCreditCardPayment($event_name, $price);
    } elseif ($payment_method == 'debit_card') {
        // Process Debit Card payment
        processDebitCardPayment($event_name, $price);
    } elseif ($payment_method == 'bank_transfer') {
        // Process Bank Transfer payment
        processBankTransferPayment($event_name, $price);
    }

    // Store the payment collection
    storePaymentCollection($event_name, $price, $payment_method);
}

// Function to process Google Pay payment
function processGooglePayPayment($event_name, $price) {
    // TO DO: Implement Google Pay payment processing
}

// Function to process Credit Card payment
function processCreditCardPayment($event_name, $price) {
    // TO DO: Implement Credit Card payment processing
}

// Function to process Debit Card payment
function processDebitCardPayment($event_name, $price) {
    // TO DO: Implement Debit Card payment processing
}

// Function to process Bank Transfer payment
function processBankTransferPayment($event_name, $price) {
    // TO DO: Implement Bank Transfer payment processing
}

// Function to store payment collection
function storePaymentCollection($event_name, $price, $payment_method) {
    require 'vendor/autoload.php';

    // Create a new MongoDB client
    $client = new MongoDB\Client("mongodb://localhost:27017");

    // Select the database
    $db = $client->M²Event;
    
    // Select the collection
    $collection = $db->cart_event;

    // Update the payment status
    $updateResult = $collection->updateOne(
        ["event_name" => $event_name],
        ['$set' => ["payment_status" => "Payment Done"]]
    );

    // Check if the update was successful
    if ($updateResult->getModifiedCount() == 1) {
        echo "Payment status updated successfully!";
    } else {
        echo "Error updating payment status!";
    }

    // Connect to MongoDB
    $db = $client->M²Event;
    $collection = $db->payments;

    // Create a new document
    $document = [
        "event_name" => $event_name,
        "price" => $price,
        "payment_method" => $payment_method,
        "payment_date" => date("Y-m-d H:i:s"),
    ];

    // Insert the document into the collection
    $result = $collection->insertOne($document);

    // Check if the document was inserted successfully
    if ($result->getInsertedCount() == 1) {
        echo "<script>alert('Payment successful!');</script>";
        echo "<script>window.location.href='cart_event.php';</script>";
    } else {
        echo "Error storing payment collection!";
    }
    $db = $client->M²Event;
    $collection = $db->cart_event;
    
    $document = [
        "event_name" => $event_name,
    ];
    
    $result = $collection->findOne($document);
    
    // Extract data from result
    $_id = $result['_id'];
    $client_name = $result['client_name'];
    $price = $result['price'];
    $payment_method = $payment_method;
    
    // Insert data into Booked collection
    $bookedCollection = $db->Booked;
    
    $bookedDocument = [
        "event_id" => $_id,
        "client_name" => $client_name,
        "price" => $price,
        "payment_method" => $payment_method,
        "payment_date" => date("Y-m-d H:i:s"),
        "status" => "Booked",
    ];
    
    $bookedResult = $bookedCollection->insertOne($bookedDocument);
    
    if ($bookedResult->getInsertedCount() == 1) {
        echo "Data inserted into Booked collection successfully!";
    } else {
        echo "Error inserting data into Booked collection!";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>M² Event - Payment</title>
    <link rel="shortcut icon" href="img/lifestyleStore.png" />
    <title>M² Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <Style>
        body {
            background-color: #222;
            /* dark mode background color */
        }
    </Style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fs-2" href="Uhome.php" style="font-family:'Great Vibes', cursive;">M² Event</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item bg-dark" href="Birthday.php" style="color: #fff;">Birthday Events</a></li>
                            <li><a class="dropdown-item bg-dark" href="Wedding.php" style="color: #fff;">Wedding Events</a></li>
                            <li><a class="dropdown-item bg-dark" href="Formal.php" style="color: #fff;">Formal Events</a></li>
                            <li><a class="dropdown-item bg-dark" href="Trd.php" style="color: #fff;">Traditional Events</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <form>
                    <a href="Uhome.php" class="btn btn-outline-primary" type="submit">Back</a>
            </form>
        </div>
    </nav>

    <div class="container" style="color: #fff;">
    <h2 class="text-center mt-5">Payment</h2>
    <p style="color: #fff;">Please confirm your payment details below:</p>
    <?php
    $event_name = $_POST['event_name'];
    $price = $_POST['price'];
    ?>
    <p style="color: #fff;">Event Name: <?php echo $event_name; ?></p>
    <p style="color: #fff;">Event Price: <?php echo $price; ?></p>
    <h5 style="color: #fff;">Payment Method:</h5>
    <form method="post">
    <input type="hidden" name="event_name" value="<?php echo $event_name; ?>">
    <input type="hidden" name="price" value="<?php echo $price; ?>">
    <div class="mb-3">
        <label for="payment_method" class="form-label" style="color: #fff;">Select Payment Method:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="google_pay" value="google_pay">
            <label class="form-check-label" for="google_pay">Google Pay</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card">
            <label class="form-check-label" for="credit_card">Credit Card</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="debit_card" value="debit_card">
            <label class="form-check-label" for="debit_card">Debit Card</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
            <label class="form-check-label" for="bank_transfer">Bank Transfer</label>
        </div>
    </div>
    <button type="submit" name="process_payment" class="btn btn-success" onclick="alert('Payment successful!')">Process Payment</button>
</form>
    <a href="terms_and_conditions.php?event_name=<?php echo $event_name; ?>&price=<?php echo $price; ?>" class="btn btn-secondary mt-3">Back to Terms and Conditions</a>
</div>
        
<script>
const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
paymentMethods.forEach((method) => {
    method.addEventListener('change', function() {
        // Remove sub details
        document.getElementById('google_pay_details').style.display = 'none';
        document.getElementById('credit_card_details').style.display = 'none';
        document.getElementById('debit_card_details').style.display = 'none';
        document.getElementById('bank_transfer_details').style.display = 'none';
    });
});
</script>
<footer class="footer">
    <div class="container">
        <center style="color: #fff;">
            <p>Copyright &copy M² Event. All Rights Reserved. | Contact Us: +91 90000 00000</p>
            <p>This website is developed by MIHIR PATEL</p>
        </center>
    </div>
</footer>
</body>
</html>