<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

require_once __DIR__ . '/../config/db.php';

// connection to DB
$database = new Database();
$db = $database->connect();

// get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// validate required fields
if (
    empty($data['name']) ||
    empty($data['address'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Name and address are required"
    ]);
    exit;
}

// sanitize inputs
$name = $data['name'];
$address = $data['address'];
$church = $data['church_affiliation'] ?? '';
$is_guest = $data['is_guest'] ?? 0;
$is_first_timer = $data['is_first_timer'] ?? 0;

// prepare query
$query = "INSERT INTO attendees (name, address, church_affiliation, is_guest, is_first_timer) VALUES (?, ?, ?, ?, ?)";

$stmt = $db->prepare($query);

$stmt->bind_param(
    "sssii",
    $name,
    $address,
    $church,
    $is_guest,
    $is_first_timer
);

// execute
if ($stmt->execute()) {
    echo json_encode([
        "statu" => "success",
        "message" => "Attendee Added Successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "messsage" => "Failed to add attendee"
    ]);
}

?>