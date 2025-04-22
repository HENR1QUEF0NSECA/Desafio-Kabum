<?php
define("HOST","localhost");
define("DB","desafiokabum");
define("USER","root");
define( "PASS","");
class MySql {
    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=".HOST.";dbname=".DB, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             return $pdo;   
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }
}
?>