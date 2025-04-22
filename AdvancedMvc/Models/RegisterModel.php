<?php
namespace Models;

use PDO;
use PDOException;

class RegisterModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function emailExiste($email): bool {
        try {
            $sql = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $sql->execute([$email]);
            return $sql->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao verificar email: " . $e->getMessage());
            return false;
        }
    }

    public function registrar($nome, $email, $senhaHash): bool {
        try {
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $resultado = $sql->execute([$nome, $email, $senhaHash]);
            
            if (!$resultado) {
                $errorInfo = $sql->errorInfo();
                error_log("Erro no registro: " . print_r($errorInfo, true));
                return false;
            }
            
            return $sql->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao registrar usuário: " . $e->getMessage());
            return false;
        }
    }
}