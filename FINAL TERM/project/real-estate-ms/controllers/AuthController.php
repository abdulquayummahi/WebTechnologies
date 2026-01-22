<?php
include_once 'config/Database.php';

class AuthController {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function login() {
        $role = $_POST['role'];
        $id = $_POST['id'];
        $pass = $_POST['password'];

        // Map Role to Table Name & ID Column
        $table = "";
        $id_col = "";

        switch ($role) {
            case 'user': $table = "user"; $id_col = "user_id"; break;
            case 'owner': $table = "property_owner"; $id_col = "property_owner_id"; break;
            case 'staff': $table = "staff"; $id_col = "staff_id"; break;
            case 'admin': $table = "admin"; $id_col = "admin_id"; break;
            default: die("Invalid Role");
        }

        // Check Credentials
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $id_col = ? AND password = ?");
        $stmt->bind_param("ss", $id, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user[$id_col]; // Generic ID storage
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $role;

            // Redirect to Master Router
            header("Location: index.php?action=dashboard");
        } else {
            echo "<script>alert('Invalid ID or Password'); window.location.href='index.php';</script>";
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
}
?>