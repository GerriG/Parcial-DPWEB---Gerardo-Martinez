<?php

class IndexController {
    public function index() {
        // Construir la ruta completa de la vista
        $viewPath = realpath(__DIR__ . '/../Views/index/index.php');
        
        // Verifica si la ruta existe
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("Error: No se encuentra la vista.");
        }
    }
}
?>



