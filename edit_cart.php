<?php
require("connection.php");

if (isset($_POST['_id']) && isset($_POST['status'])) {
    $id = new MongoDB\BSON\ObjectId($_POST['_id']);
    $status = $_POST['status'];

    $collection = $db->cart_event;
    $query = $collection->updateOne(['_id' => $id], ['$set' => ['status' => $status]]);

    if ($query->getModifiedCount() > 0) {
        echo "<script>alert('Cart status updated successfully.'); window.location.href='Ahome.php';</script>";
    } else {
        echo "Failed to update cart status.";
    }
} else {
    echo "Invalid request.";
}
?>