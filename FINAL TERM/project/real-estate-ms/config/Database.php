<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "real_estate_management_system"; // Your DB Name

    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            if ($this->conn->connect_error) {
                die("❌ DB Connection Failed: " . $this->conn->connect_error);
            }
        } catch(Exception $e) {
            die("❌ DB Error: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>