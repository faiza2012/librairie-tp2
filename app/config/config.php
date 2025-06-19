<?php
// Détection automatique de l'environnement
if (str_contains($_SERVER['HTTP_HOST'], 'localhost')) {
    define('BASE', '/Librairie_tp2/');
    define('ASSET', '/Librairie_tp2/public/');
} else {
    define('BASE', '/e2195490/Librairie_tp2/');
    define('ASSET', '/e2195490/Librairie_tp2/public/');
}
?>
