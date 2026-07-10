<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/AttendeeController.php';

// connection to DB
$database = new Database();
$db = $database->connect();

// controller
$controller = new AttendeeController($db);

// call function
$controller->addAttendee();

?>