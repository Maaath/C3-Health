<?php

require './vendor/autoload.php';

$client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

// $collection = $client->Health->exams;

// $result = $collection->find();

// foreach ($result as $entry) {
//     echo $entry['name'].'<br>';
// }

session_unset();
// require_once  'controller/homeController.php';		
// $home_controller = new homeController();	
// $home_controller->index();

session_start();
$_SESSION['user'] = null;

include "./app/views/index.php";
