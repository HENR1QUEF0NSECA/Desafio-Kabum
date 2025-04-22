<?php
class SessionManager {
    public function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['usuario_session_id'] = session_id();
    }

    public function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, $value) {
        $_SESSION[$key] = $value;
    }

    public function destruirSessao() {
        $_SESSION = [];
        session_destroy();
    }

    public function regenerarSessao() {
        session_regenerate_id(true);
        
        $_SESSION['usuario_session_id'] = session_id();
    }

    public function autenticarSessao(): bool {
        return isset($_SESSION['usuario']);
    }

    public function requerirSessao(string $redirect = 'login') {
        $this->start();
        if (!$this->autenticarSessao()) {
            header("Location: " . $redirect);
            exit;
        }
    }

    public function registrarSessaoNoBanco(string $sessionId, string $email, PDO $pdo) {
        $stmt = $pdo->prepare("UPDATE usuarios SET session_id = :session_id WHERE email = :email");
        $stmt->execute(['session_id' => $sessionId, 'email' => $email]);
    }

    public function destruirSessaoNoBanco(string $sessionId, PDO $pdo) {
        $stmt = $pdo->prepare("UPDATE usuarios SET session_id = NULL WHERE session_id = :session_id");
        $stmt->execute(['session_id' => $sessionId]);
    }

    public function verificarSessaoAtivaNoBanco(string $email, PDO $pdo): bool {
        $stmt = $pdo->prepare("SELECT session_id FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return !empty($result['session_id']);
    }

    public function getSessionId(): ?string {
        return $_SESSION['usuario_session_id'] ?? null;
    }
}
