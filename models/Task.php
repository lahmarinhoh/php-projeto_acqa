<?php

class Task {
    private $db;
    private $table = 'tasks';

    public function __construct($db) {
        $this->db = $db;
    }

    // Busca todas as tarefas de um usuário
    public function getTasksByUserId($user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Insere uma nova tarefa
    public function create($user_id, $title, $description) {
        $query = "INSERT INTO " . $this->table . " (user_id, title, description) VALUES (:user_id, :title, :description)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    // Busca uma tarefa específica (Garante que pertence ao usuário logado)
    public function getTaskById($id, $user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id AND user_id = :user_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Atualiza os dados da tarefa
    public function update($id, $user_id, $title, $description, $status) {
        $query = "UPDATE " . $this->table . " SET title = :title, description = :description, status = :status WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Remove a tarefa
    public function delete($id, $user_id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getTaskStats($user_id) {
        $query = "SELECT status, COUNT(*) as total FROM " . $this->table . " WHERE user_id = :user_id GROUP BY status";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        $stats = [
            'pendente' => 0,
            'concluida' => 0,
            'total' => 0
        ];

        foreach ($results as $row) {
            $stats[$row['status']] = $row['total'];
            $stats['total'] += $row['total'];
        }

        return $stats;
    }
}