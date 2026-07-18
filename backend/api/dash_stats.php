<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

require_once __DIR__ . '/../config/db.php';

$database = new Database();
$conn = $database->connect();

$response = [];

// total attendees
$sql = "SELECT COUNT(*) as total FROM attendees";
$result = $conn->query($sql);

$response['total'] = $result->fetch_assoc()['total'];


// total guests
$sql = "SELECT COUNT(*) as guests FROM attendees WHERE is_guest = 1";
$result = $conn->query($sql);

$response['guests'] = $result->fetch_assoc()['guests'];


// total first timers
$sql = "SELECT COUNT(*) as firstTimers FROM attendees WHERE is_first_timer = 1";
$result = $conn->query($sql);

$response['firstTimers'] = $result->fetch_assoc()['firstTimers'];


echo json_encode($response);

?>