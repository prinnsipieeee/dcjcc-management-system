<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/AttendeeController.php';

// connect DB
$database = new Database();
$db = $database->connect();

// controller
$controller = new AttendeeController($db);

$search = $_GET['search'] ?? '';
$address = $_GET['address'] ?? '';
$church = $_GET['church'] ?? '';
$firstTimer = $_GET['first_timer'] ?? '';
$isGuest = $_GET['is_guest'] ?? '';

// call function
$controller->getAttendees($search, $address, $church, $firstTimer, $isGuest);
?>