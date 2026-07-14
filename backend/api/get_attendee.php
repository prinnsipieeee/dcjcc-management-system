<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/AttendeeController.php';

// connect DB
$database = new Database();
$db = $database->connect();

// controller
$controller = new AttendeeController($db);

$search = $_GET['search'] ?? '';

// call function
$controller->getAttendees($search);
?>