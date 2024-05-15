<?php

class UserManager {
    private $username;
    private $password;
    private $conn;

    public function __construct($username, $password, $conn) {
        $this->username = $username;
        $this->password = $password;
        // Ricevo la connessione al database come parametro
        $this->conn = $conn; 
    }

    public function register() {
        $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        try {
            $stmt->execute();
            echo "<div class='alert alert-success' role='alert'>Registration completed successfully.</div>";
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger' role='alert'>Error during registration: " . $e->getMessage() . "</div>";
        }
    }

    public function login() {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            echo "<div class='alert alert-success' role='alert'>Login successful.</div>";
            return true;
        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid credentials.</div>";
            return false;
        }
    }

}

?>
