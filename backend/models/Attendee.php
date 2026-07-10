<?php

    class Attendee{
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
    }
?>