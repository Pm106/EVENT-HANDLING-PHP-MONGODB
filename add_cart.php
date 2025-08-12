<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css"> <!-- Custom CSS -->
</head>
<body>
<?php
require("connection.php");
require 'header2.php';
           ?>
<div class="container">
        <ul class="nav navbar-nav">
            <li class="active"><a href="Ahome.php">Home</a></li>
            <li><a href="Ahome.php">Manage Product</a></li>
            <li><a href="Ahome.php">Manage Supplier</a></li>
            <li><a href="Ahome.php">Order</a></li>
        </ul>
    </div>
    <div class="container mt-5">
        <h1 class="text-center">Shopping Cart</h1>

        <?php
        
        require("connection.php");

        // Function to update cart item quantity
        function updateCartItem($cart_collection, $product_id, $quantity) {
            $cart_collection->updateOne(
                ['product_id' => $product_id],
                ['$set' => ['quantity' => $quantity]]
            );
        }

        // Check if the add cart form is submitted
        if (isset($_POST['add_cart'])) {
            $product_id = $_POST['product_id'];
            try {
                $collection = $db->products;
                $query = $collection->find(['_id' => new MongoDB\BSON\ObjectID($product_id)]);
                $product = $query->toArray();
                if (count($product) > 0) {
                    $product_name = $product[0]['name'];
                    $price = $product[0]['price'];
                    $image_data = $product[0]['image'];

                    // Add product to cart collection
                    $cart_collection = $db->cart;
                    $cart_collection->insertOne([
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'price' => $price,
                        'quantity' => 1,
                        'image' => $image_data
                    ]);

                    echo '<div class="alert alert-success">Product added to cart successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger">Product not found.</div>';
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {
                echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
            }
        }

        // Remove item from cart
        if (isset($_GET['remove'])) {
            $product_id = $_GET['remove'];
            $cart_collection = $db->cart;
            $cart_collection->deleteOne(['product_id' => $product_id]);
            header('Location: add_cart.php');
            exit;
        }

        $cart_collection = $db->cart;
$query = $cart_collection->find();
$cart_items = $query->toArray();

if (isset($_POST['checkout'])) {
    // Calculate total price
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    // Display checkout message
    echo '<div class="alert alert-success">Thank you for your purchase! Your total is $' . $total_price . '.</div>';

    // Display payment options
    echo '<h2>Payment Options:</h2>';
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
    echo '<input type="radio" name="payment_method" value="credit_card"> Credit Card<br>';
    echo '<input type="radio" name="payment_method" value="paypal"> Google Pay<br>';
    echo '<input type="radio" name="payment_method" value="bank_transfer"> Bank Transfer<br>';
    echo '<button type="submit" name="pay" class="btn btn-primary">Pay</button>';
    echo '</form>';
}


// Process payment
if (isset($_POST['pay'])) {
    $payment_method = $_POST['payment_method'];
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    } switch ($payment_method) {
        case 'credit_card':
            // Calculate total price
           
            processCreditCardPayment($db, $cart_items, $total_price);
            echo '<script>
                if (confirm("Payment successful! Your order has been placed. Click OK to continue.")) {
                    // Do nothing, just close the alert box
                } else {
                    // Do nothing, just close the alert box
                }
            </script>';
            break;
        case 'paypal':
            // Process PayPal payment
            processPayPalPayment($db, $cart_items, $total_price);
            echo '<script>
                if (confirm("Payment successful! Your order has been placed. Click OK to continue.")) {
                    // Do nothing, just close the alert box
                } else {
                    // Do nothing, just close the alert box
                }
            </script>';
            break;
        case 'bank_transfer':
            // Process bank transfer payment
            processBankTransferPayment($db, $cart_items, $total_price);
            echo '<script>
                if (confirm("Payment successful! Your order has been placed. Click OK to continue.")) {
                    // Do nothing, just close the alert box
                } else {
                    // Do nothing, just close the alert box
                }
            </script>';
            break;
    }
}
        
        
            function processCreditCardPayment($db, $cart_items, $total_price) {
                // Simulate credit card payment processing
                // (in a real-world scenario, you would use a payment gateway API)
                sleep(2); // simulate payment processing time
                $payment_status = 'success';
            
                if ($payment_status == 'success') {
                    // Insert order into "orders" collection
                    $orders_collection = $db->orders;
                    foreach ($cart_items as $item) {
                        $orders_collection->insertOne([
                            'product_id' => $item['product_id'],
                            'product_name' => $item['product_name'],
                            'price' => $item['price'],
                            'quantity' => $item['quantity'],
                            'payment_method' => 'Credit Card',
                            'order_date' => date('Y-m-d H:i:s')
                        ]);
                    }
            
                    // Clear cart
                    $cart_collection = $db->cart;
                    $cart_collection->deleteMany([]);
            
                    // Display success message
                    echo '<div class="alert alert-success">Payment successful! Your order has been placed.</div>';
                } else {
                    echo '<div class="alert alert-danger">Payment failed. Please try again.</div>';
                }
            }
        // Function to process PayPal payment
        function processPayPalPayment($db, $cart_items, $total_price) {
            // Simulate PayPal payment processing
            // (in a real-world scenario, you would use PayPal's API)
            sleep(2); // simulate payment processing time
            $payment_status = 'success';
        
            if ($payment_status == 'success') {
                // Insert order into "orders" collection
                $orders_collection = $db->orders;
                foreach ($cart_items as $item) {
                    $orders_collection->insertOne([
                        'product_id' => $item['product_id'],
                        'product_name' => $item['product_name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'payment_method' => 'PayPal',
                        'order_date' => date('Y-m-d H:i:s')
                    ]);
                }
        
                // Clear cart
                $cart_collection = $db->cart;
                $cart_collection->deleteMany([]);
        
                // Display success message
                echo '<script>
                    if (confirm("Payment successful! Your order has been placed. Click OK to continue.")) {
                        // Do nothing, just close the alert box
                    } else {
                        // Do nothing, just close the alert box
                    }
                </script>';
            } else {
                echo '<div class="alert alert-danger">Payment failed. Please try again.</div>';
            }
        }

        // Function to process bank transfer payment
        function processBankTransferPayment($db, $cart_items, $total_price) {
            // Simulate bank transfer payment processing
            // (in a real-world scenario, you would use a bank transfer API)
            sleep(2); // simulate payment processing time
            $payment_status = 'success';
        
            if ($payment_status == 'success') {
                // Insert order into "orders" collection
                $orders_collection = $db->orders;
                foreach ($cart_items as $item) {
                    $orders_collection->insertOne([
                        'product_id' => $item['product_id'],
                        'product_name' => $item['product_name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'payment_method' => 'Bank Transfer',
                        'order_date' => date('Y-m-d H:i:s')
                    ]);
                }
        
                // Clear cart
                $cart_collection = $db->cart;
                $cart_collection->deleteMany([]);
        
                // Display success message
                echo '<script>
                    if (confirm("Payment successful! Your order has been placed. Click OK to continue.")) {
                        // Do nothing, just close the alert box
                    } else {
                        // Do nothing, just close the alert box
                    }
                </script>';
            } else {
                echo '<div class="alert alert-danger">Payment failed. Please try again.</div>';
            }
        }
        
        ?>

        <h2>Cart Items:</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cart_collection = $db->cart;
                $query = $cart_collection->find();
                $cart_items = $query->toArray();
                foreach ($cart_items as $item) {
                    echo '<tr>';
                    echo '<td>' . $item['product_name'] . '</td>';
                    echo '<td>$' . $item['price'] . '</td>';
                    echo '<td>' . $item['quantity'] . '</td>';
                    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" width="50" height="50"></td>';
                    echo '<td><a href="add_cart.php?remove=' . $item['product_id'] . '">Remove</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <?php
       if (is_array($cart_items) && count($cart_items) > 0) {
        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
        echo '<button type="submit" name="checkout" class="btn btn-primary">Checkout</button>';
        echo '</form>';
    }
        ?>
    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>