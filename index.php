<?php
session_start();

require_once 'config/Database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/TaskController.php';

$dbInstance = Database::getInstance();
$db = $dbInstance->getConnection();

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$authController = new AuthController($db);

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
        $dashboardController = new DashboardController($db);
        $dashboardController->index();
        break;
    case 'create_task':
        $taskController = new TaskController($db);
        $taskController->create();
        break;
    case 'edit_task':
        $taskController = new TaskController($db);
        $taskController->edit();
        break;
    case 'delete_task':
        $taskController = new TaskController($db);
        $taskController->delete();
        break;
    default:
        $authController->login();
        break;
}