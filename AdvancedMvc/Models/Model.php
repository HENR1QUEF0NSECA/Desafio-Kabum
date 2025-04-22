<?php
namespace Models;
use \MySql;
class Model {
    protected $pdo;
    public function __construct(){
        $this->pdo = MySql::connect();
    }
    public function getPdo() {
        return $this->pdo;
    }
    
}
