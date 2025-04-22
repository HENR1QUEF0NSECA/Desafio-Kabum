<?php
namespace Models;

use \PDO;
use \PDOException;

class LoginModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function autenticarUsuario(string $email, string $senha, \SessionManager $sessionManager): bool {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                if (!$sessionManager->verificarSessaoAtivaNoBanco($email, $this->pdo)) {
                    return true;
                }
            }
        } catch (PDOException $e) {
            error_log("Erro ao autenticar usuário: " . $e->getMessage());
        }

        return false;
    }

    public function obterUsuarioPorEmail(string $email): ?array {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ?: null;
        } catch (PDOException $e) {
            error_log("Erro ao obter usuário por e-mail: " . $e->getMessage());
            return null;
        }
    }
}
