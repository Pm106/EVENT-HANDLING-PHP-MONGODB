<?php
require("connection.php");

if (isset($_POST['event_name']) && isset($_POST['event_price']) && isset($_POST['event_category']) && isset($_FILES['event_image'])) {
    $event_name = $_POST['event_name'];
    $event_price = $_POST['event_price'];
    $event_category = $_POST['event_category'];
    $event_image = $_FILES['event_image'];

    // Check if the image is valid
    if ($event_image['type'] == 'image/jpeg' || $event_image['type'] == 'image/png') {
        // Upload the image
        $image_data = file_get_contents($event_image['tmp_name']);
        $collection = $db->Event;
        $collection->insertOne([
            'name' => $event_name,
            'price' => $event_price,
            'category' => $event_category,
            'image' => new MongoDB\BSON\Binary($image_data, MongoDB\BSON\Binary::TYPE_GENERIC)
        ]);

        // Redirect to manage event page
        header('Location: Ahome.php');
        exit;
    } else {
        echo "Invalid image type. Please upload a JPEG or PNG image.";
    }
} else {
    echo "Please fill in all the fields.";
}
?>