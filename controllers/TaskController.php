<?php
require_once 'models/Task.php';

class TaskController {
    private $taskModel;
    private $userId;

    public function __construct($db) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $this->taskModel = new Task($db);
        $this->userId = $_SESSION['user_id'];
    }

    // Ação de Criar Tarefa
    public function create() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = strip_tags(trim($_POST['title'] ?? ''));
            $description = strip_tags(trim($_POST['description'] ?? ''));

            if (!empty($title)) {
                if ($this->taskModel->create($this->userId, $title, $description)) {
                    header('Location: index.php?action=dashboard');
                    exit;
                } else {
                    $error = 'Erro ao salvar a tarefa.';
                }
            } else {
                $error = 'O título é obrigatório.';
            }
        }

        require_once 'views/create_task.php';
    }

    // Ação de Editar Tarefa
    public function edit() {
        $error = '';
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $task = $this->taskModel->getTaskById($id, $this->userId);
        if (!$task) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = strip_tags(trim($_POST['title'] ?? ''));
            $description = strip_tags(trim($_POST['description'] ?? ''));
            $status = $_POST['status'] ?? 'pendente';

            if (!empty($title)) {
                if ($this->taskModel->update($id, $this->userId, $title, $description, $status)) {
                    header('Location: index.php?action=dashboard');
                    exit;
                } else {
                    $error = 'Erro ao atualizar a tarefa.';
                }
            } else {
                $error = 'O título é obrigatório.';
            }
        }

        require_once 'views/edit_task.php';
    }

    // Ação de Excluir Tarefa
    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->taskModel->delete($id, $this->userId);
        }
        header('Location: index.php?action=dashboard');
        exit;
    }
}