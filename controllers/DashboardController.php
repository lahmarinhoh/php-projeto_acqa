<?php
require_once 'models/Task.php';

class DashboardController {
    private $taskModel;

    public function __construct($db) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $this->taskModel = new Task($db);
    }

    public function index() {
        $userId = $_SESSION['user_id'];
        $userName = $_SESSION['username'];

        $tasks = $this->taskModel->getTasksByUserId($userId);

        require_once 'views/dashboard.php';
    }
}