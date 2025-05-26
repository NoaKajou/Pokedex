<?php
require_once (__DIR__ . '/../controller/pdo_controller.php');
require_once 'pdo.php';

class Pokemon_Type
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new Database();
        $this->pdo = $this->pdo->getConnection();
    }
    public function affiche()
    {
        $stmt = $this->pdo->query("SELECT * FROM Pokemon_Type ORDER BY id_pokemon ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPokemonByType($typeId)
    {
        $stmt = $this->pdo->prepare("SELECT p.* FROM Pokemon p JOIN Pokemon_Type pt ON p.id = pt.id_pokemon WHERE pt.id_type = ?");
        $stmt->execute([$typeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTypesByPokemon($pokemonId)
    {
        $stmt = $this->pdo->prepare("SELECT t.* FROM Type t JOIN Pokemon_Type pt ON t.id = pt.id_type WHERE pt.id_pokemon = ?");
        $stmt->execute([$pokemonId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}