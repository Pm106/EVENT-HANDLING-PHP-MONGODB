<!-- show_products.php -->
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
?>

<html>
<head>
    <title>Show Products</title>
</head>
<body>
    <h1>Show Products</h1>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
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
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>