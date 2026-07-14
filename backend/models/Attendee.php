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
            $query .= " AND address = ?";
            $params[] = $address;
            $types .= "s";
        }

        // filter by church
        if(!empty($church)) {
            $query .= " AND church_affiliation LIKE ?";
            $params [] = "%" . $church . "%";
            $types .= "s";
        }

        // filter by first timer
        if($firstTimer !== '') {
            $query .= " AND is_first_timer = ?";
            $params [] = $firstTimer;
            $types .= "i";
        }

        // filter by is guest
        if($isGuest !== ''){
            $query .= " AND is_guest = ? ";
            $params[] = $isGuest;
            $types .= "i";
        }


        // echo $query;
        // print_r($params);
        // exit;

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