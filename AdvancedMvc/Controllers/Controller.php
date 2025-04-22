<?php
namespace Controllers;
class Controller {
    protected $view;
    protected $model;
    protected $session;
    public function __construct($view,$model) {
        $this->view = $view;
        $this->model = $model;
        $this->session = new \SessionManager();
    }
    public function index() {
        
    }
    
}
?>