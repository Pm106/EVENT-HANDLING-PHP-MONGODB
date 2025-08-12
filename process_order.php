<?php
require("connection.php");

$id = $_POST["id"];
$status = $_POST["status"];

$collection = $db->cart_event;
$query = $collection->updateOne(["_id" => $id], ['$set' => ["status" => $status]]);

?>