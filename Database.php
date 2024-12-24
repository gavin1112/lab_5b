<?php
class Database {
    private $host = "localhost";
    private $db = "lab_5b";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);

        if($this->conn->connect_error) {
            die("Connection Failed : " . $this->conn->connect_error);
        } 
        else {
            // echo "Connected Successfully";
        }

        return $this->conn;
    }
}

// // Create an instance of the Database class
// $database = new Database();

// // Call the getConnection() method to establish a connection to the database
// $conn = $database->getConnection();
?>