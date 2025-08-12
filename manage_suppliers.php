<!-- manage_suppliers.php -->
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
?>

<html>
<head>
    <title>Manage Suppliers</title>
</head>
<body>
    <h1>Manage Suppliers</h1>
    <table>
        <tr>
            <th>Supplier ID</th>
            <th>Supplier Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Mobile No</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php
        $mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $db = new MongoDB\Driver\Database($mongoClient, 'veggie_mart');
        $collection = new MongoDB\Driver\Collection($db, 'suppliers');
        $cursor = $collection->find();
        foreach ($cursor as $document) {
            echo "<tr>";
            echo "<td>" . $document['supplierId'] . "</td>";
            echo "<td>" . $document['supplierName'] . "</td>";
            echo "<td>" . $document['address'] . "</td>";
            echo "<td>" . $document['city'] . "</td>";
            echo "<td>" . $document['mobileNo'] . "</td>";
            echo "<td>" . $document['email'] . "</td>";
            echo "<td>" . $document['password'] . "</td>";
            echo "<td><a href='edit_supplier.php?id=" . $document['_id'] . "'>Edit</a> | <a href='delete_supplier.php?id=" . $document['_id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>