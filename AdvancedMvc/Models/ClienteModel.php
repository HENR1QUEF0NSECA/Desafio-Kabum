<?php
namespace Models;

use \PDO;
use \PDOException;
use \Exception;

class ClienteModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function listarTodos(): array {
        try {
            $stmt = $this->pdo->query("SELECT * FROM clientes");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao listar clientes: " . $e->getMessage() . "');</script>";
            return [];
        }
    }

    public function cadastrar(string $nome, string $dataNascimento, string $cpf, string $rg, ?string $telefone): bool {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM clientes WHERE cpf = :cpf");
            $stmt->execute(['cpf' => $cpf]);
            $cpfExistente = $stmt->fetchColumn();
    
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM clientes WHERE rg = :rg");
            $stmt->execute(['rg' => $rg]);
            $rgExistente = $stmt->fetchColumn();
    
            if ($cpfExistente > 0) {
                throw new Exception("Erro: O CPF informado já está cadastrado.");
            }
            if ($rgExistente > 0) {
                throw new Exception("Erro: O RG informado já está cadastrado.");
            }
    
            $stmt = $this->pdo->prepare("
                INSERT INTO clientes 
                (nome, data_nascimento, cpf, rg, telefone) 
                VALUES 
                (:nome, :data_nascimento, :cpf, :rg, :telefone)
            ");
            
            $stmt->execute([
                'nome' => $nome,
                'data_nascimento' => $dataNascimento,
                'cpf' => $cpf,
                'rg' => $rg,
                'telefone' => $telefone,
            ]);
            return true;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao cadastrar cliente: " . $e->getMessage() . "');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('" . $e->getMessage() . "');</script>";
            return false;
        }
    }
    
    public function buscarPorId(int $id): ?array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            return $cliente ?: null;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao buscar cliente: " . $e->getMessage() . "');</script>";
            return null;
        }
    }

    public function editar($id, $nome, $datanascimento, $cpf, $rg, $telefone) {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM clientes WHERE cpf = :cpf AND id != :id");
            $stmt->execute(['cpf' => $cpf, 'id' => $id]);
            $cpfExistente = $stmt->fetchColumn();
    
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM clientes WHERE rg = :rg AND id != :id");
            $stmt->execute(['rg' => $rg, 'id' => $id]);
            $rgExistente = $stmt->fetchColumn();
    
            if ($cpfExistente > 0) {
                throw new Exception("Erro: O CPF informado já está cadastrado para outro usuário.");
            }
            if ($rgExistente > 0) {
                throw new Exception("Erro: O RG informado já está cadastrado para outro usuário.");
            }
    
            $sql = "UPDATE clientes SET nome = ?, data_nascimento = ?, cpf = ?, rg = ?, telefone = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$nome, $datanascimento, $cpf, $rg, $telefone, $id]);
    
            return true;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao editar cliente: " . $e->getMessage() . "');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('" . $e->getMessage() . "');</script>";
            return false;
        }
    }
    
    public function deletar(int $id): bool {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao deletar cliente: " . $e->getMessage() . "');</script>";
            return false;
        }
    }
}