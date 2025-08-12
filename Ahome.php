<html>
<head>
    <title>M² Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
       </head>
<body>
<?php
require("connection.php");
require 'header2.php';
           ?>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=manage_Event">Manage Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=manage_supplier">Manage User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=manage_cart">Manage cart Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=order">Report</a>
            </li>
        </ul>
    </div>
</nav>
    <div class="container">
    <?php
// Database connection
require("connection.php");

// Check if the page parameter is set
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}
// Add Event to cart
if (isset($_POST['buy_now'])) {
    $product_id = $_POST['product_id'];
    $collection = $db->Event;
    $query = $collection->find(['_id' => $product_id]);
    $Event = $query->toArray();
    if (count($Event) > 0) {
        $product_name = $Event[0]['name'];
        $price = $Event[0]['price'];
        $image_data = $Event[0]['image'];

        // Add Event to cart collection
        $cart_collection = $db->cart;
        $cart_collection->insertOne([
            'product_id' => $product_id,
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => 1,
            'image' => $image_data
        ]);

        // Redirect to cart.php
        header('Location: cart.php');
        exit;
    }
}
if ($page == 'home') {
    // Home page content
    ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Dashboard</h1>
            <p class="text-center">Overview of User, Event, Cart, Booked, and Payment Data</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <?php
                    $collection = $db->User ;
                    $query = $collection->find();
                    $users = $query->toArray();
                    ?>
                    <p class="card-text"><?php echo count($users); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Events</h5>
                    <?php
                    $collection = $db->Event;
                    $query = $collection->find();
                    $events = $query->toArray();
                    ?>
                    <p class="card-text"><?php echo count($events); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Cart Events</h5>
                    <?php
                    $collection = $db->cart_event;
                    $query = $collection->find();
                    $cartEvents = $query->toArray();
                    ?>
                    <p class="card-text"><?php echo count($cartEvents); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Booked Events</h5>
                    <?php
                    $collection = $db->Booked;
                    $query = $collection->find();
                    $bookedEvents = $query->toArray();
                    ?>
                    <p class="card-text"><?php echo count($bookedEvents); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payment Overview</h5>
                    <?php
                    $collection = $db->payments;
                    $query = $collection->find();
                    $payments = $query->toArray();
                    ?>
                    <p class="card-text">Total Payments: <?php echo count($payments); ?></p>
                    <p class="card-text">Total Amount: <?php echo array_sum(array_column($payments, 'price')); ?></p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
    <?php
}elseif ($page == 'manage_Event') {
    // Manage Event page content
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Manage Event</h1>
                <p class="text-center">Add, edit, and delete Event</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Add New Event</h2>
                <form action="add_event.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="event_name">Event Name:</label>
                        <input type="text" class="form-control" id="event_name" name="event_name" required>
                    </div>
                    <div class="form-group">
                        <label for="event_price">Event Price:</label>
                        <input type="number" class="form-control" id="event_price" name="event_price" required>
                    </div>
                    <div class="form-group">
                        <label for="event_category">Event Category:</label>
                        <select class="form-control" id="event_category" name="event_category" required>
                            <option value="">Select Category</option>
                            <option value="Birthday Events">Birthday Events</option>
                            <option value="Wedding Events">Wedding Events</option>
                            <option value="Formal Events">Formal Events</option>
                            <option value="Traditional Events">Traditional Events</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="event_image">Event Image:</label>
                        <input type="file" class="form-control" id="event_image" name="event_image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Event</button>
                </form>
            </div>
        </div>
        <div class="row">
            <?php
            $collection = $db->Event;
            $query = $collection->find();
            $Event = $query->toArray();
            if (count($Event) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Event ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Event as $row) {
                            $image_data = $row["image"]->getData();
                            $image_src = 'data:image/jpeg;base64,' . base64_encode($image_data);
                            ?>
                            <tr>
                                <td><img src="<?php echo $image_src; ?>" alt="<?php echo $row["name"]; ?>" style="width: 250px; height: 150px; object-fit: cover;"></td>
                                <td><?php echo $row["_id"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["price"]; ?></td>
                                <td><?php echo $row["category"]; ?></td>
                                <td>
                                <a href="edit_event.php?_id=<?php echo $row["_id"]; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete_event.php?_id=<?php echo $row["_id"]; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p>No Event available.</p>";
            }
            ?>
        </div>
    </div>
    <?php
} elseif ($page == 'manage_cart') {
    // Manage Cart page content
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Manage Cart</h1>
                <p class="text-center">View and edit cart items</p>
            </div>
        </div>
        <div class="row">
            <?php
            $collection = $db->cart_event;
            $query = $collection->find();
            $cart = $query->toArray();
            if (count($cart) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Event Name</th>
                            <th>Client Name</th>
                            <th>Client Email</th>
                            <th>Client Mobile Number</th>
                            <th>Event Date</th>
                            <th>Event Starting Time</th>
                            <th>Event Ending Time</th>
                            <th>Venue Address</th>
                            <th>Additional Information</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cart as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row["event_name"]; ?></td>
                                <td><?php echo $row["client_name"]; ?></td>
                                <td><?php echo $row["client_email"]; ?></td>
                                <td><?php echo $row["client_mobile_number"]; ?></td>
                                <td><?php echo $row["event_date"]; ?></td>
                                <td><?php echo $row["event_starting_time"]; ?></td>
                                <td><?php echo $row["event_ending_time"]; ?></td>
                                <td><?php echo $row["venue_address"]; ?></td>
                                <td><?php echo $row["additional_information"]; ?></td>
                                <td><?php echo $row["booking_date"]; ?></td>
                                <td><?php echo $row["status"]; ?></td>
                                <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $row["_id"]; ?>">Process</button>
                            </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p>No cart items available.</p>";
            }
            ?>
        </div>
    </div>
    <?php foreach ($cart as $row) { ?>
    <div class="modal fade" id="editModal<?php echo $row["_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Options</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit_cart.php" method="post">
                        <input type="hidden" name="_id" value="<?php echo $row["_id"]; ?>">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Approved">Approved</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <?php
} elseif ($page == 'manage_supplier') {
    // Manage User page content
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Manage User</h1>
                <p class="text-center">View and manage User details</p>
            </div>
        </div>
        <div class="row">
            <?php
            $collection = $db->User;
            $query = $collection->find();
            $User = $query->toArray();
            if (count($User) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($User as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row["_id"]; ?></td>
                                <td><?php echo isset($row["username"]) ? $row["username"] : 'N/A'; ?></td>
                               <td><?php echo isset($row["mobile_number"]) ? $row["mobile_number"] : 'N/A'; ?></td>
                                <td><?php echo isset($row["email"]) ? $row["email"] : 'N/A'; ?></td>
                                <td>
                               <!-- <a href="edit_user.php?_id=<?php echo $row["_id"]; ?>" class="btn btn-primary">Edit</a> -->
                                <a href="delete_user.php?_id=<?php echo $row["_id"]; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p>No User available.</p>";
            }
            ?>
        </div>
    </div>
<?php
} elseif ($page == 'order') {
// Display orders collection data report
$orders_collection = $db->Booked;
$orders = $orders_collection->find();
?>
<table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Report ID</th>
            <th scope="col">Event ID</th>
            <th scope="col">Event Name</th>
            <th scope="col">Price</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Order Date</th>
            <th>Download</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Fetch data from Booked collection
        $db = $client->M²Event;
        $collection = $db->Booked;

        $result = $collection->find();

        $data = $result->toArray();

        if (count($data) > 0) {
            foreach ($data as $row) {
                ?>
                <tr>
                    <td><?php echo $row['_id']; ?></td>
                    <td><?php echo $row['event_id']; ?></td>
                    <td><?php echo $row['client_name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td><?php echo $row['payment_date']; ?></td>
                    <td>
                    <a href="download_report.php?_id=<?php echo $row['_id']; ?>&event_id=<?php echo $row['event_id']; ?>&client_name=<?php echo $row['client_name']; ?>&price=<?php echo $row['price']; ?>&payment_method=<?php echo $row['payment_method']; ?>&payment_date=<?php echo $row['payment_date']; ?>" class="btn btn-primary">Download</a>
                </td>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No data available.</td>
            </tr>
            <?php
        }
        ?>

    </tbody>
</table>
<?php

}
?><br><br><br><br><br><br></div>
<footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy M² Event. All Rights Reserved. | Contact Us: +91 90000 00000</p>
                   <p>This website is developed by MIHIR PATEL</p>
               </center>
               </div>
           </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
</body>   
</html>