<?php

class Attendee {
    private $conn;
    private $table = "attendees";

    public function __construct($db){
        $this->conn = $db;
    }
    
    public function create($data) {
        $name = $data['name'];
        $address = $data['address'];
        $church = $data['church_affiliation'];
        $is_guest = $data['is_guest'];
        $is_first_timer = $data['is_first_timer'];

        $sql = "INSERT INTO " . $this->table . "
        (name, address, church_affiliation, is_guest, is_first_timer)
        VALUES ('$name', '$address', '$church', '$is_guest', '$is_first_timer')";

        return $this->conn->query($sql);
    }

    public function getAll($search = '')
    {
        if ($search != '') {
            $query = "SELECT * FROM attendees WHERE name LIKE ?";
            $stmt = $this->conn->prepare($query);
            $searchParam = "%" . $search . "%";
            $stmt->bind_param("s", $searchParam);
        } else {
            $query = "SELECT * FROM attendees";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}

?>