<?php
require("connection.php");

if (isset($_GET['_id'])) {
    $event_id = $_GET['_id'];
    $collection = $db->Event;
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($event_id)]);
    header('Location: Ahome.php');
    exit;
}
?>