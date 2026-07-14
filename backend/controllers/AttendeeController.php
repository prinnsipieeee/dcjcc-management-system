<?php
require_once __DIR__ . '/../models/Attendee.php';

class AttendeeController {
    private $model;

    public function __construct($db) {
        $this->model = new Attendee($db);
    }

    public function addAttendee() {
        $data = json_decode(file_get_contents("php://input"), true);

        if(!$data) {
            echo json_encode([
                "success" => false,
                "message" => "No data received"
            ]);
            return;
        }

        $result = $this->model->create($data);

        if ($result) {
            echo json_encode([
                "success" => true,
                "message" => "Attendee Added Successfully"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Failed to Add attendees"
            ]);
        }
    }

    public function getAttendees()
    {
        $search = $_GET['search'] ?? '';
        $address   = $_GET['address'] ?? '';
        $church = $_GET['church'] ?? '';
        $firstTimer = $_GET['first_timer'] ?? '';
        $isGuest = $_GET['is_guest'] ?? '';

        $result = $this->model->getAll($search, $address, $church, $firstTimer, $isGuest);

        echo json_encode($result);
    }
}
?>