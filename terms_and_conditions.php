<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>M² Event - Terms and Conditions</title>
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
        <h2 class="text-center mt-5">Terms and Conditions</h2>
        <p style="color: #fff;">Please read the following terms and conditions carefully before proceeding with your payment.</p>
        <h5 style="color: #fff;">Event Details:</h5>
        <?php
        $_id = $_GET['_id'];
        $client_name = $_GET['client_name'];
        $price = $_GET['price'];
        $event_name = $_GET['event_name'];
    
        ?>
        <p style="color: #fff;">Event Name: <?php echo $event_name; ?></p>
        <p style="color: #fff;">Event Price: <?php echo $price; ?></p>
        <h5 style="color: #fff;">1. Payment Terms</h5>
        <p style="color: #fff;">All payments must be made in full prior to the event date.</p>
        <h5 style="color: #fff;">2. Cancellation Policy</h5>
        <p style="color: #fff;">Cancellations must be made at least 48 hours in advance to receive a full refund.</p>
        <h5 style="color: #fff;">3. Liability</h5>
        <p style="color: #fff;">M² Event is not liable for any damages or losses incurred during the event.</p>
        <h5 style="color: #fff;">4. Acceptance of Terms</h5>
        <p style="color: #fff;">By proceeding with the payment, you agree to these terms and conditions.</p>
        <div class="text-center mt-4">
        <form action="payment.php" method="post">
            <input type="hidden" name="_id" value="<?php echo $_id; ?>">
            <input type="hidden" name="client_name" value="<?php echo $client_name; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <input type="hidden" name="event_name" value="<?php echo $event_name; ?>">
            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
            <a href="cart_event.php" class="btn btn-secondary">Back to Cart</a>
        </div>
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