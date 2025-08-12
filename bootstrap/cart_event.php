<?php
session_start();
require("connection.php");

$collection = $db->cart_event;
$query = $collection->find();
$cartEvents = $query;

if ($cartEvents) {
    ?>
    <html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>M² Event</title>
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <style>
            img {
                width: 650px;
                height: 300px;
            }
            h2 {
                
            }
            .figure img {
                width: 150px;
                height: 1500px;
            }
            
        
            .image-with-text {
                position: relative;
            }
            #background-video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 500px;
                object-fit: cover;
                z-index: -1;
            }

            .container {
                position: relative;
                z-index: 1;
            }
        </style>
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
        <div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Cart Events</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Client Name</th>
                                    <th>Client Email</th>
                                    <th>Event Date</th>
                                    <th>Event Starting Time</th>
                                    <th>Event Ending Time</th>
                                    <th>Venue Address</th>
                                    <th>Additional Information</th>
                                    <th>Booking Date</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartEvents as $cartEvent) { ?>
                                <tr>
                                    <td><?php echo $cartEvent['event_name']; ?></td>
                                    <td><?php echo $cartEvent['client_name']; ?></td>
                                    <td><?php echo $cartEvent['client_email']; ?></td>
                                    <td><?php echo $cartEvent['event_date']; ?></td>
                                    <td><?php echo $cartEvent['event_starting_time']; ?></td>
                                    <td><?php echo $cartEvent['event_ending_time']; ?></td>
                                    <td><?php echo $cartEvent['venue_address']; ?></td>
                                    <td><?php echo $cartEvent['additional_information']; ?></td>
                                    <td><?php echo $cartEvent['booking_date']; ?></td>
                                    <td><?php echo $cartEvent['status']; ?></td>
                                    <td><?php echo $cartEvent['price']; ?></td>
                                    <td><?php echo $cartEvent['payment_status']; ?></td>
                                    <td>
                                        <?php if ($cartEvent['status'] == 'Approved') { ?>
                                            <form action="payment.php" method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $cartEvent['user_id']; ?>">
                                                <input type="hidden" name="event_id" value="<?php echo $cartEvent['_id']; ?>">
                                                <input type="hidden" name="event_name" value="<?php echo $cartEvent['event_name']; ?>">
                                                <input type="hidden" name="client_name" value="<?php echo $cartEvent['client_name']; ?>">
                                                <input type="hidden" name="client_email" value="<?php echo $cartEvent['client_email']; ?>">
                                                <input type="hidden" name="event_date" value="<?php echo $cartEvent['event_date']; ?>">
                                                <input type="hidden" name="event_starting_time" value="<?php echo $cartEvent['event_starting_time']; ?>">
                                                <input type="hidden" name="event_ending_time" value="<?php echo $cartEvent['event_ending_time']; ?>">
                                                <input type="hidden" name="venue_address" value="<?php echo $cartEvent['venue_address']; ?>">
                                                <input type="hidden" name="additional_information" value="<?php echo $cartEvent['additional_information']; ?>">
                                                <input type="hidden" name="booking_date" value="<?php echo $cartEvent['booking_date']; ?>">
                                                <input type="hidden" name="status" value="<?php echo $cartEvent['status']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $cartEvent['price']; ?>">
                                                <input type="hidden" name="payment_status" value="<?php echo $cartEvent['payment_status']; ?>">
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to proceed with the payment?')">Pay Now</button>
                                            </form>
                                        <?php } else { ?>
                                            <p>Payment not available</p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "No cart events found.";
}
?>