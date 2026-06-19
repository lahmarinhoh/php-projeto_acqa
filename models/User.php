<?php

class User {
    private $db;
    private $table = 'users';

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        if ($this->emailExists($email)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->db->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        return $stmt->execute();
    }

    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    public function login($email, $password) {
        $query = "SELECT id, username, password FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function getUserById($id) {
        $query = "SELECT id, username, email FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateProfile($id, $username, $email, $password = null) {
        if (!empty($password)) {
            $query = "UPDATE " . $this->table . " SET username = :username, email = :email, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $hashed_password);
        } else {
            $query = "UPDATE " . $this->table . " SET username = :username, email = :email WHERE id = :id";
            $stmt = $this->db->prepare($query);
        }

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
}