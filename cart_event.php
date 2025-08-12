<?php
session_start();
require("connection.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>M² Event - Cart</title>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
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
        <h2 class="text-center mt-5">Your Cart</h2>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Client name</th>
                    <th scope="col">Event Date</th>
                    <th scope="col">Event Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Import the MongoDB driver
                require 'vendor/autoload.php';

                // Create a new MongoDB client
                $client = new MongoDB\Client("mongodb://localhost:27017");

                // Select the database
                $db = $client->M²Event;

                // Select the collection
                $collection = $db->cart_event;

                // Find all documents in the collection
                $events = $collection->find();

                // Check if $events is not empty
                if (!empty($events)) {
                    // Fetch events from MongoDB
                    foreach ($events as $event) {
                        {
                ?>
                <tr>
                    <td><?php echo $event['event_name']; ?></td>
                    <td><?php echo $event['client_name']; ?></td>
                    <td><?php echo $event['event_date']; ?></td>
                    <td><?php echo isset($event['price']) ? $event['price'] : 'N/A'; ?></td>
                    <td><?php echo $event['status']; ?></td>
                    <td>
                    <?php
// Check if the status is "Approved"
if ($event['status'] == "Approved") {
    // Check if the payment status is defined
    if (isset($event['payment_status'])) {
        // Check if the payment status is "Payment Done"
        if ($event['payment_status'] == "Payment Done") {
            ?>
            <p style="color: #fff;">Payment Done</p>
            <?php
        } else {
            ?>
            <a href="terms_and_conditions.php?_id=<?php echo $event['_id']; ?>&client_name=<?php echo $event['client_name']; ?>&price=<?php echo $event['price']; ?>&event_name=<?php echo $event['event_name']; ?>">Pay Now</a>
            <?php
        }
    } else {
        ?>
        <a href="terms_and_conditions.php?_id=<?php echo $event['_id']; ?>&client_name=<?php echo $event['client_name']; ?>&price=<?php echo $event['price']; ?>&event_name=<?php echo $event['event_name']; ?>">Pay Now</a>
        <?php
    }
} else {
    ?>
    <p style="color: #fff;">Your event is not approved yet. Please wait for the approval.</p>
    <?php
}
?>
                    </td>
                </tr>
                <?php } } } else { ?>
                <tr>
                    <td colspan="6">No events found.</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

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