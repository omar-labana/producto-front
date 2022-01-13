<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Book.php';
include_once '../models/Furniture.php';
include_once '../models/DVD.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));
$targets = $data->targets;

foreach ($targets as $target) {
    $type =  $target->type;
    $product = new $type();
    $product->populate($target);
    $product->deleteProduct($db);
}

echo "Success";



// $type = $data->type;

// $product = new $type();
// $product->populate($data);
// $product->deleteProduct($db);