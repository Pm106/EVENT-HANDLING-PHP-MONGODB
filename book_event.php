<?php
session_start();
require("connection.php");

$eventId = $_GET['event_id'];
$collection = $db->Event;
$query = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($eventId)]);
$event = $query;

if ($event) {
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
                color: aliceblue;
            }

            .figure img {
                width: 150px;
                height: 1500px;
            }

            body {
                color: aliceblue;
                background-color: #222;
                /* dark mode background color */
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
                    <a href="logout.php" class="btn btn-outline-primary" type="submit">Logout</a>
                </form>
            </div>
        </nav>

        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Book Event: <?php echo $event['name']; ?></h2>
                        <form action="" method="post">
                            <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile_number">Mobile Number:</label>
                                <input type="text" name="mobile_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="event_date">Event Date:</label>
                                <input type="date" name="event_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="event_starting_time">Event Starting Time:</label>
                                <input type="time" name="event_starting_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="event_ending_time">Event Ending Time:</label>
                                <input type="time" name="event_ending_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="venue_address">Venue Address:</label>
                                <textarea name="venue_address" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="additional_information">Additional Information:</label>
                                <textarea name="additional_information" class="form-control"></textarea>
                            </div>
                            <button type="submit" name="book_event" class="btn btn-primary">Request For Approval</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Event not found.";
}

if (isset($_POST['book_event'])) {
  // Process the booking form
  $eventId = $_POST['event_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobileNumber = $_POST['mobile_number'];
  $eventDate = $_POST['event_date'];
  $eventStartingTime = $_POST['event_starting_time'];
  $eventEndingTime = $_POST['event_ending_time'];
  $venueAddress = $_POST['venue_address'];
  $additionalInformation = $_POST['additional_information'];

  // Get the user's unique ID from the session
  $userId = $_SESSION['_id'];

  // Find the event's price
  $eventCollection = $db->Event;
  $eventQuery = $eventCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($eventId)]);
  $eventPrice = $eventQuery['price'];

  // Insert the booking data into the cart_event collection
  $cartEventCollection = $db->cart_event;
  $cartEventCollection->insertOne([
      'user_id' => new MongoDB\BSON\ObjectId($userId),
      'event_id' => new MongoDB\BSON\ObjectId($eventId),
      'event_name' => $eventQuery['name'],
      'client_name' => $name,
      'client_email' => $email,
      'client_mobile_number' => $mobileNumber,
      'event_date' => $eventDate,
      'event_starting_time' => $eventStartingTime,
      'event_ending_time' => $eventEndingTime,
      'venue_address' => $venueAddress,
      'additional_information' => $additionalInformation,
      'booking_date' => date('Y-m-d H:i:s'),
      'status' => 'Request Processing..',
      'price' => $eventPrice,
      'payment_status' => 'pending..'
  ]);

  // Display a confirmation message to the user
  echo "<script>alert('Your request has been sent successfully.');</script>";
  echo "<script>window.location.href='Uhome.php';</script>";
}
?>