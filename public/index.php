<?php

use App\Core\Database;
use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = \App\Core\Database::getConnection(); // Connexion PDO
$router = new \App\Core\Router($pdo);       // Injection dans Router
$router->route();
