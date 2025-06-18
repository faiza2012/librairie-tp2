<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PageController
{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function accueil()
    {
        echo $this->twig->render('pages/accueil.twig');
    }

    public function error404()
    {
        echo $this->twig->render('error/404.twig');
    }
    

}
