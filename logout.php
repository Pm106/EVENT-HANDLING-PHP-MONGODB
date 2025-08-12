<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    // Unset and destroy the session variables
    session_unset();
    session_destroy();

    // Require the connection file
    require("connection.php");

    // Log out the user
    $filter = ["username" => $_SESSION["username"]];
    $update = ['$set' => ["logged_in" => false]];
    $options = ["upsert" => false];
    $collection->updateOne($filter, $update, $options);

    // Close the MongoDB connection
    if (isset($mongoClient)) {
        $mongoClient->close();
    }
} else {
    echo "Username is not set in the session.";
}

// Redirect to the login page
header('Location: login.php');
exit;
?>