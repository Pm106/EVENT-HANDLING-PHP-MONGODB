
<?php
// Connect to MongoDB
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->cake;
$orderCollection = $db->orders;

// Get the order ID from the URL parameter
$orderId = new MongoDB\BSON\ObjectId($_GET['order_id']);

// Find the order document
$order = $orderCollection->findOne(['_id' => $orderId]);

// If the order is not found, display an error message
if (!$order) {
    echo "Order not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
     h1 {
        color: springgreen;
     }
    </style>
</head>
<body>
    <h1>YOUR ORDER HAS CONFIRMED!</h1><br>
    <h3><b>Thank you for your order...</b><h3><br><br>
    <p>Order ID: <?php echo $order['_id']; ?></p>
    <p>Order Date: <?php echo date('Y-m-d H:i:s'); ?></p>
    <p>Order Total: <?php echo $order['total']; ?></p>
    <h2>Order Details:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['cartItems'] as $cartItem) { ?>
                <?php
                $productId = $cartItem['productId'];
                $productCollection = $db->product_detail;
                $product = $productCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
                ?>
                <tr>
                    <td><?php echo $product['cakeName']; ?></td>
                    <td><?php echo $cartItem['quantity']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $cartItem['quantity'] * $product['price']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
<?php
include "footer.php";
?>