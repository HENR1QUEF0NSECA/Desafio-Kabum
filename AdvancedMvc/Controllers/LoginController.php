<?php
namespace Controllers;

class LoginController extends Controller {
    public function __construct($view, $model) {
        parent::__construct($view, $model);
    }

    public function index() {
        $this->session->start();

        if ($this->session->autenticarSessao()) {
            echo "<script>window.location.href = 'home';</script>";
            exit;
        }

        if (isset($_POST['entrar'])) {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $usuario = $this->model->obterUsuarioPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $pdo = $this->model->getPdo();

                if (!$this->session->verificarSessaoAtivaNoBanco($email, $pdo)) {
                    $this->session->regenerarSessao();
                    $sessionId = session_id();
                    $this->session->set('usuario', $email);
                    $this->session->set('usuario_session_id', $sessionId);
                    $this->session->registrarSessaoNoBanco($sessionId, $email, $pdo);
                } else {
                    session_id($usuario['session_id']);
                    $this->session->start();
                    $this->session->set('usuario', $email);
                    $this->session->set('usuario_session_id', $usuario['session_id']);
                }

                echo "<script>window.location.href = 'home';</script>";
                exit;
            } else {
                echo "<script>alert('Usuário ou senha inválidos.');</script>";
            }
        }

        $this->view->Render('login.php', 'header.php');
    }
}