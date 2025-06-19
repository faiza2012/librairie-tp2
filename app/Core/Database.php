<?php
namespace App\Core;

use PDO;             // pour créer une instance PDO
use PDOException;    // pour attraper les erreurs PDO dans le catch


class Database {
    public static function getConnection() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=e2195490;charset=utf8mb4", "e2195490", "e2195490");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}
