<?php
class Database {
    private $host = "localhost";
    private $db_name = "dcjcc_db";
    private $username = "root";
    private $password = "";

    public function connect() {
        $conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );

        if ($conn->connect_error) {
            echo json_encode(["error" => "Database connection failed"]);
            exit();
        }

        return $conn;
    }
}
?>