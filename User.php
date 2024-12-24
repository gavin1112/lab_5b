<?php
include_once 'Database.php';

class User {
    private $conn;

    //constructor class
    public function __construct($db) {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function newUser($matric, $name, $password, $role) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $matric, $name, $password, $role);
            $result = $stmt->execute();

            if ($result) {
                return true;
            }
            else {
                return "Error : " . $stmt->error;
            }

        }
        else {
            return "Error : " . $this->conn->error;
        }

        $this->conn->close();
    }

    public function getUsers() {
        $sql = "SELECT matric, name, role FROM users";
        $result = $this->conn->query($sql);

        $this->conn->close();

        return $result;
    }

    public function deleteUser($matric) {
        $sql = "DELETE FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $matric);
            $result = $stmt->execute();

            if ($result) {
                return true;
            }
            else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function updateUser($matric, $name, $role) {
        $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sss", $name, $role, $matric);
            $result = $stmt->execute();
       
            if ($result) {
                return true;
            } else {
            return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
        return "Error: " . $this->conn->error;
        }
    }
}

?>