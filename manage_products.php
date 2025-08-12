 <!-- manage_products.php -->
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
?>

<html>
<head>
    <title>Manage Products</title>
</head>
<body>
    <h1>Manage Products</h1>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php
        $mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $db = new MongoDB\Driver\Database($mongoClient, 'veggie_mart');
        $collection = new MongoDB\Driver\Collection($db, 'products');
        $cursor = $collection->find();
        foreach ($cursor as $document) {
            echo "<tr>";
            echo "<td>" . $document['productId'] . "</td>";
            echo "<td>" . $document['productName'] . "</td>";
            echo "<td>" . $document['price'] . "</td>";
            echo "<td>" . $document['quantity'] . "</td>";
            echo "<td><a href='edit_product.php?id=" . $document['_id'] . "'>Edit</a> | <a href='delete_product.php?id=" . $document['_id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>