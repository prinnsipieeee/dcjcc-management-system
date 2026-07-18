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

    public function getAll($search = '', $address = '', $church = '', $firstTimer = '', $isGuest = '') {

        $query = "SELECT * FROM attendees WHERE 1=1";

        $params = [];
        $types = "";

        // filter by name
        if (!empty($search)) {
            $query .= " AND name LIKE ?";
            $params[] = "%" . $search . "%";
            $types .= "s";
        }

        // filter by address
        if (!empty($address)) {
            $query .= " AND address LIKE ?";
            $params[] = "%" . $address . "%";
            $types .= "s";
        }

        // filter by church
        if(!empty($church)) {
            $query .= " AND church_affiliation LIKE ?";
            $params [] = "%" . $church . "%";
            $types .= "s";
        }

        if ($isGuest !== '' || $firstTimer !== '') {

        $query .= " AND (";

        $conditions = [];

        if ($isGuest !== '') {
            $conditions[] = "is_guest = ?";
            $params[] = $isGuest;
            $types .= "i";
        }

        if ($firstTimer !== '') {
            $conditions[] = "is_first_timer = ?";
            $params[] = $firstTimer;
            $types .= "i";
        }

        $query .= implode(" OR ", $conditions);
        $query .= ")";
    }

        $stmt = $this->conn->prepare($query);

        if(!empty($params)){
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
        
    }
}

?>