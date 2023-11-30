<?php
session_start();
include 'modelo/conexiondb.php';

if(isset($_SESSION['baneado']) && $_SESSION['baneado']==1){
    if (isset($_GET['ban']) && $_GET['ban']=="salir") {
        session_destroy();
        header("location: index.php");
    }else{
        include 'controlador/baneado.php';
        $ban =new baneadoController();
        $ban->default();
    }
    exit();
}
// Enrutamiento
$controllerName = isset($_GET['u']) ? $_GET['u'] : 'index';
$method = isset($_GET['m']) ? $_GET['m'] : 'default';

// Mapeo de rutas a controladores
$controllers = [
    'index' => 'IndexController',
    'product' => 'ProductController',
    'secciones' => 'SeccionesController',
    'inicio' => 'LoginController',
    'registro' => 'RegisController',
    'perfil' => 'PerfilController',
    'seccion' => 'SeccionController',
    'admin' => 'AdminController',
    'baneado' => 'baneadoController',
    'manual' => 'ManualController'
];

// Verificar si la ruta solicitada existe en el mapeo
if (array_key_exists($controllerName, $controllers)) {
    $controllerClass = $controllers[$controllerName];
    $controllerFile = 'controlador/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerClass();

        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            echo "Error 404. Método no encontrado.";
        }
    } else {
        echo "Error 404. Controlador no encontrado.";
    }
} else {
    echo "Error 404. Ruta no encontrada.";
}
?>