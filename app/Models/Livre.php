<?php
namespace App\Models;

use PDO;

class Livre
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM livre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM livre WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getWithDetails() {
        $stmt = $this->pdo->query("SELECT livre.*, categorie.nom AS categorie, editeur.nom AS editeur
                                   FROM livre
                                   JOIN categorie ON livre.categorie_id = categorie.id
                                   JOIN editeur ON livre.editeur_id = editeur.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id, $data)
{
    $stmt = $this->pdo->prepare("UPDATE livre SET titre = ?, auteur = ?, prix = ?, categorie_id = ?, editeur_id = ? WHERE id = ?");
    return $stmt->execute([
        $data['titre'],
        $data['auteur'],
        $data['prix'],
        $data['categorie_id'],
        $data['editeur_id'],
        $id
    ]);
}
public function create($data)
{
    $stmt = $this->pdo->prepare("INSERT INTO livre (titre, auteur, prix, categorie_id, editeur_id) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([
        $data['titre'],
        $data['auteur'],
        $data['prix'],
        $data['categorie_id'],
        $data['editeur_id']
    ]);
}
public function insert($data)
{
    $stmt = $this->pdo->prepare("INSERT INTO livre (titre, auteur, prix, categorie_id, editeur_id) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([
        $data['titre'],
        $data['auteur'],
        $data['prix'],
        $data['categorie_id'],
        $data['editeur_id']
    ]);
}
public function delete($id)
{
    $stmt = $this->pdo->prepare("DELETE FROM livre WHERE id = ?");
    return $stmt->execute([$id]);
}


}
