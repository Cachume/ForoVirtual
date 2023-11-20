<?php
session_start();
include 'modelo/conexiondb.php';
// Enrutamiento
$controllerName = isset($_GET['u']) ? $_GET['u'] : 'index';
$method = isset($_GET['m']) ? $_GET['m'] : 'default';

// Mapear rutas a controladores
$controllers = [
    'index' => 'IndexController',
    'product' => 'ProductController',
    'secciones' => 'SeccionesController',
    'inicio' => 'LoginController',
    'registro' => 'RegisController',
    'perfil' => 'PerfilController',
    'seccion' => 'SeccionController',
    'admin' => 'AdminController'
];

// Verificar si la ruta solicitada existe en el mapeo
if (array_key_exists($controllerName, $controllers)) {
    $controllerClass = $controllers[$controllerName];
    $controllerFile = 'controlador/' . $controllerName . '.php';

    // Comprobar si el archivo del controlador existe
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerClass();

        // Comprobar si el método existe en el controlador
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            // Manejo de error: método no encontrado
            echo "Error 404. Método no encontrado.";
        }
    } else {
        // Manejo de error: archivo de controlador no encontrado
        echo "Error 404. Controlador no encontrado.";
    }
} else {
    // Manejo de error: ruta no encontrada en el mapeo
    echo "Error 404. Ruta no encontrada.";
}
?>