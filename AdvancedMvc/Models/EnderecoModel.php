<?php
namespace Models;

use \PDO;
use \PDOException;
use \InvalidArgumentException;

class EnderecoModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function listarTodos(): array {
        try {
            $stmt = $this->pdo->query("SELECT * FROM enderecos");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar endereços: " . $e->getMessage());
            return [];
        }
    }

    public function cadastrar(array $dadosEndereco): bool {
        $camposObrigatorios = ['cliente_id', 'estado', 'cidade', 'bairro', 'logradouro', 'numero', 'cep'];
        foreach ($camposObrigatorios as $campo) {
            if (empty($dadosEndereco[$campo])) {
                throw new InvalidArgumentException("O campo {$campo} é obrigatório");
            }
        }

        try {
            $sql = "INSERT INTO enderecos 
                    (cliente_id, estado, cidade, bairro, logradouro, numero, complemento, cep) 
                    VALUES 
                    (:cliente_id, :estado, :cidade, :bairro, :logradouro, :numero, :complemento, :cep)";
            
            $stmt = $this->pdo->prepare($sql);
            
            $params = [
                ':cliente_id' => (int)$dadosEndereco['cliente_id'],
                ':estado' => $dadosEndereco['estado'],
                ':cidade' => $dadosEndereco['cidade'],
                ':bairro' => $dadosEndereco['bairro'],
                ':logradouro' => $dadosEndereco['logradouro'],
                ':numero' => $dadosEndereco['numero'],
                ':complemento' => $dadosEndereco['complemento'] ?? null,
                ':cep' => $dadosEndereco['cep']
            ];
            
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar endereço: " . $e->getMessage());
            return false;
        }
    }

    public function buscarPorId(int $id): ?array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM enderecos WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("Erro ao buscar endereço: " . $e->getMessage());
            return null;
        }
    }

    public function editar(array $dados): bool {
        $camposObrigatorios = ['id', 'estado', 'cidade', 'bairro', 'logradouro', 'numero', 'cep'];
        foreach ($camposObrigatorios as $campo) {
            if (empty($dados[$campo])) {
                throw new InvalidArgumentException("O campo {$campo} é obrigatório");
            }
        }

        try {
            $sql = "UPDATE enderecos SET 
                    estado = :estado, 
                    cidade = :cidade, 
                    bairro = :bairro, 
                    logradouro = :logradouro, 
                    numero = :numero, 
                    complemento = :complemento, 
                    cep = :cep 
                    WHERE id = :id";
            
            $stmt = $this->pdo->prepare($sql);
            
            $params = [
                ':id' => (int)$dados['id'],
                ':estado' => $dados['estado'],
                ':cidade' => $dados['cidade'],
                ':bairro' => $dados['bairro'],
                ':logradouro' => $dados['logradouro'],
                ':numero' => $dados['numero'],
                ':complemento' => $dados['complemento'] ?? null,
                ':cep' => $dados['cep']
            ];
            
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erro ao editar endereço: " . $e->getMessage());
            return false;
        }
    }

    public function deletar(int $id): bool {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM enderecos WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao deletar endereço: " . $e->getMessage());
            return false;
        }
    }

    public function listarPorCliente(int $clienteId): array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM enderecos WHERE cliente_id = :cliente_id");
            $stmt->execute([':cliente_id' => $clienteId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar endereços do cliente: " . $e->getMessage());
            return [];
        }
    }
}