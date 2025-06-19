<?php
require_once("../Classe/Livre.php");


$livre = new Livre();
$livres = $livre->getWithDetails();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des livres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="banner">
    <img src="images/banner.jpg" alt="Bannière de la librairie">
</div>

<div class="navbar">
    <h2>Librairie</h2>
    <ul>
        <li><a href="ajouter.php" class="btn add">Ajouter un livre</a></li>
    </ul>
</div>

<h1>Liste des livres</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Éditeur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($livres as $l): ?>
            <tr>
                <td><?= $l['id'] ?></td>
                <td><?= $l['titre'] ?></td>
                <td><?= $l['auteur'] ?></td>
                <td><?= $l['prix'] ?> $</td>
                <td><?= $l['categorie'] ?></td>
                <td><?= $l['editeur'] ?></td>

                <td>
                    <a class="btn" href="modifier.php?id=<?= $l['id'] ?>">Modifier</a>
                    <a class="btn delete" href="supprimer.php?id=<?= $l['id'] ?>" onclick="return confirm('Supprimer ce livre ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<footer>
    Projet TP2 -librairie- Web avancé .
</footer>

</body>
</html>
