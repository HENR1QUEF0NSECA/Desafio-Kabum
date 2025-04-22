<?php
class Application {
    const DEFAULT_CLASS = "Login";

    public function run() {
        $url = isset($_GET["url"]) ? explode("/", trim($_GET["url"], "/")) : [];
        
        $className = ucfirst($url[0] ?? self::DEFAULT_CLASS);
        $method = $url[1] ?? 'index';
        
        $controllerClass = "Controllers\\{$className}Controller";
        $viewClass = "Views\\{$className}View";
        $modelClass = "Models\\{$className}Model";
        
        try {
            if (!class_exists($controllerClass)) {
                throw new Exception("Controller não encontrado");
            }
            
            $controller = new $controllerClass(new $viewClass, new $modelClass);
            $params = array_slice($url, 2);
            
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                if (count($params) > 0) {
                    $controller->index($params[0]);
                } else {
                    $controller->index();
                }
            }
        } catch (Exception $e) {
            http_response_code(404);
            echo "<script>alert('Página não encontrada!'); window.location.href = 'login';</script>";
        }
    }
}