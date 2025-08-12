<?php
require_once 'vendor/autoload.php'; 
use Dompdf\Dompdf;
$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->M²Event; // or $client->selectDatabase('M²Event')
$collection = $db->admins;
$booked_collection = $db->Booked; // Select the 'products' collection
$GLOBALS['con'] = $collection;
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$database = new MongoDB\Database($manager, 'M²Event');
$collection = $database->selectCollection('User');
?>