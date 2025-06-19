<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/config/config.php';

use App\Core\Database;
use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = \App\Core\Database::getConnection(); // Connexion PDO
$router = new \App\Core\Router($pdo);       // Injection dans Router
$router->route();
