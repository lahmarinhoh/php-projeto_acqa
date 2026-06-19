<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function login() {
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = trim($_POST['password'] ?? '');

            if ($email && !empty($password)) {
                $user = $this->userModel->login($email, $password);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    header('Location: index.php?action=dashboard');
                    exit;
                } else {
                    $error = 'E-mail ou senha incorretos.';
                }
            } else {
                $error = 'Por favor, preencha todos os campos corretamente.';
            }
        }
        
        require_once 'views/login.php';
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = strip_tags(trim($_POST['username'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = trim($_POST['password'] ?? '');

            if (!empty($username) && $email && !empty($password)) {
                if (strlen($password) < 6) {
                    $error = 'A senha deve ter pelo menos 6 caracteres.';
                } elseif ($this->userModel->register($username, $email, $password)) {
                    $success = 'Cadastro realizado com sucesso! Prossiga para o login.';
                } else {
                    $error = 'Este e-mail já está cadastrado ou ocorreu um erro.';
                }
            } else {
                $error = 'Preencha todos os campos de forma válida.';
            }
        }

        require_once 'views/register.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}