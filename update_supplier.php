<?php
require("connection.php");

if (isset($_POST['_id']) && isset($_POST['username']) && isset($_POST['mob']) && isset($_POST['email'])) {
    $supplier_id = new MongoDB\BSON\ObjectId($_POST['_id']);
    $username = $_POST['username'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];

    $collection = $db->suppliers;
    $collection->updateOne(['_id' => $supplier_id], ['$set' => ['username' => $username, 'mob' => $mob, 'email' => $email]]);

    header('Location : Ahome.php');
    exit;
} else {
    echo "<p>Invalid request.</p>";
}
?>