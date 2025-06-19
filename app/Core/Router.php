<?php

namespace App\Core;

class Router
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function route()
{
    $controllerName = $_GET['controller'] ?? 'page';
    $action = $_GET['action'] ?? 'accueil';

    $controllerClass = "\\App\\Controllers\\" . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass($this->pdo);

        if (method_exists($controller, $action)) {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller->$action($id);
            } else {
                $controller->$action();
            }
         
            
            return;
        }
    }

    // ✅ Route invalide — afficher la page d'erreur 404 
    echo $GLOBALS['twig']->render('error/404.twig');

    
}
}
