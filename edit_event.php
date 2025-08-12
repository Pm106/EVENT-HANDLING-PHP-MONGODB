<?php
require("connection.php");

if (isset($_GET['_id'])) {
    $event_id = $_GET['_id'];
    $collection = $db->Event;
    $query = $collection->find(['_id' => new MongoDB\BSON\ObjectID($event_id)]);
    $event = $query->toArray();

    if (count($event) > 0) {
        $event_name = $event[0]['name'];
        $event_price = $event[0]['price'];
        $event_category = $event[0]['category'];
        $event_image = $event[0]['image']->getData();
        $event_image_src = 'data:image/jpeg;base64,' . base64_encode($event_image);
    } else {
        echo "Event not found.";
        exit;
    }
}

if (isset($_POST['update_event'])) {
    $event_name = $_POST['event_name'];
    $event_price = $_POST['event_price'];
    $event_category = $_POST['event_category'];
    $event_image = $_FILES['event_image'];

    if ($event_image['type'] == 'image/jpeg' || $event_image['type'] == 'image/png') {
        $image_data = file_get_contents($event_image['tmp_name']);
        $collection = $db->Event;
        $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($event_id)],
            ['$set' => [
                'name' => $event_name,
                'price' => $event_price,
                'category' => $event_category,
                'image' => new MongoDB\BSON\Binary($image_data, MongoDB\BSON\Binary::TYPE_GENERIC)
            ]]
        );
    } else {
        $collection = $db->Event;
        $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($event_id)],
            ['$set' => [
                'name' => $event_name,
                'price' => $event_price,
                'category' => $event_category
            ]]
        );
    }

    header('Location: Ahome.php');
    exit;
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="event_name">Event Name:</label>
        <input type="text" class="form-control" id="event_name" name="event_name" value="<?php echo $event_name; ?>" required>
    </div>
    <div class="form-group">
        <label for="event_price">Event Price:</label>
        <input type="number" class="form-control" id="event_price" name="event_price" value="<?php echo $event_price; ?>" required>
    </div>
    <div class="form-group">
        <label for="event_category">Event Category:</label>
        <select class="form-control" id="event_category" name="event_category" required>
            <option value="<?php echo $event_category; ?>"><?php echo $event_category; ?></option>
            <option value="Birthday Events">Birthday Events</option>
            <option value="Wedding Events">Wedding Events</option>
            <option value="Anniversary Events">Anniversary Events</option>
            <option value="Corporate Events">Traditional Events</option>
        </select>
    </div>
    <div class="form-group">
        <label for="event_image">Event Image:</label>
        <input type="file" class="form-control" id="event_image" name="event_image">
        <img src="<?php echo $event_image_src; ?>" alt="<?php echo $event_name; ?>" style="width: 50px; height: 50px; object-fit: cover;">
    </div>
    <button type="submit" name="update_event" class="btn btn-primary">Update Event</button>
</form>