<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../models/Generics.php';
include_once '../models/Interaction.php';
include_once '../models/Book.php';
include_once '../models/DVD.php';
include_once '../models/Furniture.php';

$generics = new Generics();
$interaction = new Interaction();

$decodedRequest = $generics->decodeRequest(file_get_contents('php://input'));
$targets = $decodedRequest->targets;

foreach ($targets as $target) {
	$type =  $target->type;
	$product = new $type();
	$interaction->setProduct($product);
  $interaction->deleteProduct();
}
