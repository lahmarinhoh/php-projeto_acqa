<?php
require_once 'models/User.php';

class ProfileController {
    private $userModel;
    private $userId;

    public function __construct($db) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $this->userModel = new User($db);
        $this->userId = $_SESSION['user_id'];
    }

    public function edit() {
        $error = '';
        $success = '';

        $user = $this->userModel->getUserById($this->userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = strip_tags(trim($_POST['username'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = trim($_POST['password'] ?? '');

            if (!empty($username) && $email) {
                if ($this->userModel->updateProfile($this->userId, $username, $email, $password)) {
                    $_SESSION['username'] = $username;
                    $success = 'Perfil atualizado com sucesso!';
                    $user = $this->userModel->getUserById($this->userId); 
                } else {
                    $error = 'Erro ao atualizar. Verifique se o e-mail já não está em uso.';
                }
            } else {
                $error = 'Nome de usuário e e-mail são obrigatórios.';
            }
        }

        require_once 'views/edit_profile.php';
    }
}