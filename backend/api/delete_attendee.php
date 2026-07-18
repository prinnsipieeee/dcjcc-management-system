<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once __DIR__ . "/../config/db.php";

$database = new Database();
$conn = $database->connect();

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["error" => "No ID Provided"]);
    exit();
}

$stmt = $conn->prepare("DELETE FROM attendees WHERE id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode([
        "success" => true,
        "message" => "Deleted successfully",
        "deleted_id" => $id
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "No record found",
        "received_id" => $id
    ]);
}

?>