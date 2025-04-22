<?php
namespace Controllers;

class ClienteController extends Controller {
    public function __construct($view, $model) {
        parent::__construct($view, $model);
    }

    public function index() {
        $this->session->start();
        $this->session->requerirSessao();

        $clientes = $this->model->listarTodos();
        $this->view->Render('cliente.php', 'header2.php', null, $clientes);
    }

    public function cadastrar() {
        $this->session->start();
        $this->session->requerirSessao();

        if (isset($_POST['cadastrar'])) {
            $nome = $_POST["nome"] ?? '';
            $datanascimento = $_POST["data_nascimento"] ?? '';
            $cpf = $_POST["cpf"] ?? '';
            $rg = $_POST["rg"] ?? '';
            $telefone = $_POST["telefone"] ?? '';

            $resultado = $this->model->cadastrar($nome, $datanascimento, $cpf, $rg, $telefone);
            if ($resultado) {
                echo "<script>alert('Registrado com sucesso!'); window.location.href = '/advancedmvc/cliente';</script>";
                exit;
            }
        }

        $this->view->Render('clienteCadastrar.php', 'header2.php');
    }

    public function editar($id = null) {
        $this->session->start();
        $this->session->requerirSessao();

        if (!$id) {
            echo "<script>alert('ID não informado!'); window.location.href = 'cliente';</script>";
            return;
        }

        if (isset($_POST['deletar'])) {
            $resultado = $this->model->deletar($id);
            if ($resultado) {
                echo "<script>alert('Deletado com sucesso!'); window.location.href = '/advancedmvc/cliente';</script>";
                exit;
            }
        }

        if (isset($_POST['salvar'])) {
            $nome = $_POST["nome"] ?? '';
            $datanascimento = $_POST["data_nascimento"] ?? '';
            $cpf = $_POST["cpf"] ?? '';
            $rg = $_POST["rg"] ?? '';
            $telefone = $_POST["telefone"] ?? '';

            $resultado = $this->model->editar($id, $nome, $datanascimento, $cpf, $rg, $telefone);
            if ($resultado) {
                echo "<script>alert('Editado com sucesso!'); window.location.href = '/advancedmvc/cliente';</script>";
                exit;
            }       
        }

        $cliente = $this->model->buscarPorId($id);
        $this->view->Render('clienteEditar.php', 'header2.php', null, ['cliente' => $cliente]);
    }
}