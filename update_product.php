<?php
session_start();

require("connection.php");

// Get the product ID from the form
$product_id = $_POST['product_id'];

// Get the updated product details from the form
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_FILES['product_image'];

// Check if the product ID is set
if (!isset($product_id)) {
    echo "Error: Product ID is not set.";
    exit;
}

// Update the product details in the database
$collection = $db->products;
$query = $collection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectId($product_id)],
    ['$set' => ['name' => $product_name, 'price' => $product_price]]
);

// Check if the update was successful
if ($query->getModifiedCount() == 1) {
    echo "Product updated successfully.";
    header("Location: Ahome.php");
    exit;
} else {
    echo "Error: Unable to update product.";
    exit;
}

// Update the product image if a new image is uploaded
if (isset($product_image) && $product_image['size'] > 0) {
    $image_data = file_get_contents($product_image['tmp_name']);
    $collection = $db->products;
    $query = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($product_id)],
        ['$set' => ['image' => $image_data]]
    );
}
?>