<?php

class Router {
    public static function route($request) {
        // Obtiene el nombre del controlador y el método desde el request
        $controllerName = ucfirst($request['controller']) . 'Controller';
        $methodName = $request['method'] ?? 'index';

        // Define la ruta del archivo del controlador
        $controllerPath = __DIR__ . '/../Controllers/' . $controllerName . '.php';

        // Verifica si el archivo del controlador existe
        if (!file_exists($controllerPath)) {
            die("Error: No se encuentra el controlador en la ruta '$controllerPath'");
        }

        // Incluye el archivo del controlador
        require_once $controllerPath;

        // Verifica si la clase del controlador existe
        if (!class_exists($controllerName)) {
            die("Error: La clase '$controllerName' no existe en '$controllerPath'");
        }

        // Crea una instancia del controlador
        $controller = new $controllerName();

        // Verifica si el método existe en el controlador
        if (!method_exists($controller, $methodName)) {
            die("Error: El método '$methodName' no existe en el controlador '$controllerName'");
        }

        // Llama al método del controlador
        $controller->$methodName($_POST ?? []);
    }
}
