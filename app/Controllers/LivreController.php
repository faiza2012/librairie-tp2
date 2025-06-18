<?php
namespace App\Controllers;

use App\Models\Livre;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use PDO;

class LivreController
{
    private $twig;
    private $livreModel;

    public function __construct(PDO $pdo)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
        $this->livreModel = new Livre($pdo);
    }

    public function index()
    {
        $livres = $this->livreModel->getWithDetails();

        echo $this->twig->render('livres/index.twig', [
            'livres' => $livres
        ]);
    }

    public function modifier($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = trim($_POST['titre']);
        $auteur = trim($_POST['auteur']);
        $prix = $_POST['prix'];
        $categorie_id = $_POST['categorie_id'];
        $editeur_id = $_POST['editeur_id'];

        // Validation
        $errors = [];
        if (empty($titre)) $errors[] = "Le titre est requis.";
        if (empty($auteur)) $errors[] = "L’auteur est requis.";
        if (!is_numeric($prix) || $prix < 0) $errors[] = "Le prix doit être un nombre positif.";
        if (!is_numeric($categorie_id)) $errors[] = "Catégorie invalide.";
        if (!is_numeric($editeur_id)) $errors[] = "Éditeur invalide.";

        if (empty($errors)) {
            $this->livreModel->update($id, [
                'titre' => $titre,
                'auteur' => $auteur,
                'prix' => $prix,
                'categorie_id' => $categorie_id,
                'editeur_id' => $editeur_id
            ]);
            header('Location: index.php');
            exit;
        }

        // Réaffichage avec erreurs
        echo $this->twig->render('livres/modifier.twig', [
            'errors' => $errors,
            'livre' => $_POST + ['id' => $id]
        ]);
    } else {
        $livre = $this->livreModel->getById($id);
        echo $this->twig->render('livres/modifier.twig', [
            'livre' => $livre
        ]);
    }
}


    public function ajouter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = trim($_POST['titre']);
            $auteur = trim($_POST['auteur']);
            $prix = $_POST['prix'];
            $categorie_id = $_POST['categorie_id'];
            $editeur_id = $_POST['editeur_id'];
    
            // Validation
            $errors = [];
            if (empty($titre)) $errors[] = "Le titre est requis.";
            if (empty($auteur)) $errors[] = "L’auteur est requis.";
            if (!is_numeric($prix) || $prix < 0) $errors[] = "Le prix doit être un nombre positif.";
            if (!is_numeric($categorie_id)) $errors[] = "Catégorie invalide.";
            if (!is_numeric($editeur_id)) $errors[] = "Éditeur invalide.";
    
            if (empty($errors)) {
                $this->livreModel->insert([
                    'titre' => $titre,
                    'auteur' => $auteur,
                    'prix' => $prix,
                    'categorie_id' => $categorie_id,
                    'editeur_id' => $editeur_id
                ]);
                header('Location: index.php');
                exit;
            }
    
            // En cas d'erreur, réafficher le formulaire avec messages
            echo $this->twig->render('livres/ajouter.twig', [
                'errors' => $errors,
                'livre' => $_POST
            ]);
        } else {
            echo $this->twig->render('livres/ajouter.twig');
        }
    }
    

    public function supprimer($id)
    {
        $this->livreModel->delete($id);
        header('Location: index.php');
        exit;
    }
}

