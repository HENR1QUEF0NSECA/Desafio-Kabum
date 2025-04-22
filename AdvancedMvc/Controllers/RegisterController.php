<?php
namespace Controllers;

class RegisterController extends Controller {
    public function __construct($view, $model) {
        parent::__construct($view, $model);
    }

    public function index() {
        $this->session->start();
        
        if (isset($_POST["registrar"])) {
            $nome = trim($_POST["nome"] ?? '');
            $email = trim($_POST["email"] ?? '');
            $senha = $_POST["senha"] ?? '';
            
            if (empty($nome) || empty($email) || empty($senha)) {
                $this->view->Render('register.php', 'header.php', null, ['erro' => 'Todos os campos devem ser preenchidos!']);
                return;
            }
    
            if ($this->model->emailExiste($email)) {
                $this->view->Render('register.php', 'header.php', null, ['erro' => 'Email já cadastrado!']);
                return;
            }
    
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $this->model->registrar($nome, $email, $hash);
            echo "<script>window.location.href = 'login';</script>";
            exit;

        } else {
            $this->view->Render('register.php', 'header.php');
        }
    }
    }
