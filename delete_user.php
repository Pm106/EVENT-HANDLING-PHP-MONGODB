<?php
require("connection.php");

if (isset($_GET['_id'])) {
    $user_id = $_GET['_id'];
    $collection = $db->User ;
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($user_id)]);
    header('Location: Ahome.php');
    exit;
}
?>