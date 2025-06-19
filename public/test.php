<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$pdo = Database::getConnection();

echo "✅ Connexion à la base réussie.";
