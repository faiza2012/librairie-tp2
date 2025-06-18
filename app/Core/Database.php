<?php
namespace App\Core;

use PDO;

class Database
{
    public static function getConnection(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=librairie_tp2;charset=utf8", "root", "");
    }
}
