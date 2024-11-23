<?php

// Redirige a la página correspondiente según la petición.
require_once "../core/Router.php";

$request = [
    'controller' => $_GET['controller'] ?? 'Index', // Default controller is 'Index'
    'method' => $_GET['method'] ?? 'index' // Default method is 'index'
];
if ($_GET['controller'] == 'Author' && $_GET['method'] == 'view') {
    $authorController = new AuthorController();
    $authorController->view($_GET['id']); // Aquí debes pasar 'id' correctamente
}

Router::route($request);

?>
