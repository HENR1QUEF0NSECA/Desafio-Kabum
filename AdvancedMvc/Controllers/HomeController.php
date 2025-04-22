<?php
namespace Controllers;

use MySql;
class HomeController extends Controller {
    public function __construct($view,$model) {
        parent::__construct($view,$model);
    }
    public function index() { 
        $this->session->start();
        $this->session->requerirSessao();
    
        if (isset($_POST["sair"])) {
            $this->logout();
        }
        $this->view->Render("home.php","header2.php");
    }
    public function logout() {
        $usuario = $this->session->get('usuario');
        if ($usuario) {
            $pdo = $this->model->getPdo();
            $this->session->destruirSessaoNoBanco(session_id(), $pdo);
            $this->session->destruirSessao();
        }
        header("Location: login");
        exit;
    }
}
