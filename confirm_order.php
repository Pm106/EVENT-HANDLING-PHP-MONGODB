<?php
require("connection.php");

$cart_id = $_GET['cart_id'];

// Get the cart item
$collection = $db->cart;
$query = $collection->findOne(array('_id' => $cart_id));
$cart_item = $query;

// Check if the cart item exists
if ($cart_item !== null) {
    echo "Cart item found: " . json_encode($cart_item) . "\n";
    // Insert the cart item into the orders collection
    $order_collection = $db->orders;
    $order_collection->insertOne($cart_item);

    // Update the order status in the cart collection
    $collection->updateOne(array('_id' => $cart_id), array('$set' => array('order_status' => 'confirmed')));

    header('Location: cart.php');
    exit;
} else {
    echo "Cart item not found. _id: $cart_id\n";
    echo "Collection: " . json_encode($collection) . "\n";
    echo "Query: " . json_encode($query) . "\n";
    exit;
}
?>