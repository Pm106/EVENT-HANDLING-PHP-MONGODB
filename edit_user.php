<?php
require("connection.php");

if (isset($_GET['_id'])) {
    $user_id = $_GET['_id'];
    $collection = $db->User ;
    $query = $collection->find(['_id' => new MongoDB\BSON\ObjectID($user_id)]);
    $user = $query->toArray();

    if (count($user) > 0) {
        $username = $user[0]['username'];
        $mobile_number = $user[0]['mobile_number'];
        $email = $user[0]['email'];
    } else {
        echo "User  not found.";
        exit;
    }
}

if (isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];

    $collection = $db->User ;
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($user_id)],
        ['$set' => [
            'username' => $username,
            'mobile_number' => $mobile_number,
            'email' => $email
        ]]
    );

    header('Location: Ahome.php');
    exit;
}

?>

<form action="" method="post">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
    </div>
    <div class="form-group">
        <label for="mobile_number">Mobile Number:</label>
        <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $mobile_number; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
    </div>
    <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
</form>