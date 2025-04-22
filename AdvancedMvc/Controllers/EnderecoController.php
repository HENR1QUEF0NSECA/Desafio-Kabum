<?php
namespace Controllers;

class EnderecoController extends Controller {
    public function __construct($view, $model) {
        parent::__construct($view, $model);
    }

    public function index($id_cliente = null) {
        $this->session->start();
        $this->session->requerirSessao();
    
        if (!$id_cliente || !is_numeric($id_cliente)) {
            echo "<script>alert('ID do cliente inválido!'); history.back();</script>";
            return;
        }
    
        $enderecos = $this->model->listarPorCliente((int)$id_cliente);
        $cliente = ["id_cliente" => $id_cliente];
        $this->view->Render('endereco.php', 'header2.php', null, $enderecos, $cliente);
    }

    public function cadastrar($id_cliente = null) {
        $this->session->start();
        $this->session->requerirSessao();
    
        if (!$id_cliente || !is_numeric($id_cliente)) {
            echo "<script>alert('ID do cliente inválido!'); history.back();</script>";
            return;
        }
    
        if (isset($_POST['cadastrar'])) {
            $dadosEndereco = [
                'cliente_id' => (int)$id_cliente,
                'logradouro' => $_POST['logradouro'] ?? '',
                'numero' => $_POST['numero'] ?? '',
                'complemento' => $_POST['complemento'] ?? null,
                'bairro' => $_POST['bairro'] ?? '',
                'cidade' => $_POST['cidade'] ?? '',
                'estado' => $_POST['estado'] ?? '',
                'cep' => $_POST['cep'] ?? ''
            ];
    
            $camposObrigatorios = ['logradouro', 'numero', 'bairro', 'cidade', 'estado', 'cep'];
            $erros = [];
            
            foreach ($camposObrigatorios as $campo) {
                if (empty($dadosEndereco[$campo])) {
                    $erros[] = ucfirst($campo);
                }
            }
    
            if (!empty($erros)) {
                echo "<script>alert('Os seguintes campos são obrigatórios: " . implode(', ', $erros) . "');</script>";
            } else {
                $resultado = $this->model->cadastrar($dadosEndereco);
                
                if ($resultado) {
                    echo "<script>alert('Endereço cadastrado com sucesso!'); window.location.href = '/advancedmvc/endereco/index/{$id_cliente}';</script>";                    exit;
                } else {
                    echo "<script>alert('Erro ao cadastrar endereço!');</script>";
                }
            }
        }
    
        $cliente = ["id_cliente" => $id_cliente];
        $this->view->Render('enderecoCadastrar.php', 'header2.php', null, null, $cliente);
    }
    public function editar($id = null) {
        $this->session->start();
        $this->session->requerirSessao();
    
        if (!$id || !is_numeric($id)) {
            echo "<script>alert('ID do endereço inválido!'); history.back();</script>";
            return;
        }
    
        $endereco = $this->model->buscarPorId((int)$id);
        
        if (!$endereco) {
            echo "<script>alert('Endereço não encontrado!'); history.back();</script>";
            return;
        }
    
        if (isset($_POST['deletar'])) {
            $resultado = $this->model->deletar((int)$_POST['id']);
            if ($resultado) {
                echo "<script>alert('Endereço excluído com sucesso!'); window.location.href = '/advancedmvc/endereco/index/{$endereco['cliente_id']}';</script>";
                exit;
            } else {
                echo "<script>alert('Erro ao excluir endereço!');</script>";
            }
        }
    
        if (isset($_POST['salvar'])) {
            $dados = [
                'id' => (int)$_POST['id'],
                'logradouro' => $_POST['logradouro'] ?? '',
                'numero' => $_POST['numero'] ?? '',
                'complemento' => $_POST['complemento'] ?? null,
                'bairro' => $_POST['bairro'] ?? '',
                'cidade' => $_POST['cidade'] ?? '',
                'estado' => $_POST['estado'] ?? '',
                'cep' => $_POST['cep'] ?? ''
            ];
    
            $camposObrigatorios = ['logradouro', 'numero', 'bairro', 'cidade', 'estado', 'cep'];
            foreach ($camposObrigatorios as $campo) {
                if (empty($dados[$campo])) {
                    echo "<script>alert('O campo {$campo} é obrigatório!');</script>";
                    $this->view->Render('enderecoEditar.php', 'header2.php', null, ['endereco' => $endereco]);
                    return;
                }
            }
    
            $resultado = $this->model->editar($dados);
            if ($resultado) {
                echo "<script>alert('Endereço atualizado com sucesso!'); window.location.href = '/advancedmvc/endereco/index/{$endereco['cliente_id']}';</script>";
                exit;
            } else {
                echo "<script>alert('Erro ao atualizar endereço!');</script>";
            }
        }
        
        if (isset($_POST["deletar"])) {
            $resultado = $this->model->deletar($id);
            if ($resultado) {
                echo "<script>alert('Deletado com sucesso!'); window.location.href = '/advancedmvc/cliente';</script>";
                exit;
            }
        }
        $this->view->Render('enderecoEditar.php', 'header2.php', null, ['endereco' => $endereco]);
    }
}