<?php
require_once (__DIR__ . '/../controller/pdo_controller.php');
require_once 'pdo.php';

class Pokemon
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new Database();
        $this->pdo = $this->pdo->getConnection();
    }
    public function affiche()
    {
        $stmt = $this->pdo->query("SELECT * FROM Pokemon ORDER BY numero ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function afficheGeneration()
    {
        $stmt = $this->pdo->query("SELECT * FROM Pokemon WHERE id_gen = ?");
        $stmt->execute([$this->id_gen]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function affichePokemon($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Pokemon WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function ajouterPokemon($numero, $name, $weight, $height, $sexe, $talent, $legendary, $id_gen, $image)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Pokemon (numero, name, weight, height, sexe, talent, legendary, id_gen, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$numero, $name, $weight, $height, $sexe, $talent, $legendary, $id_gen, $image]);
    }
}
?>