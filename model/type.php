<?php
require_once (__DIR__ . '/../controller/pdo_controller.php');
require_once 'pdo.php';

class Type
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new Database();
        $this->pdo = $this->pdo->getConnection();
    }
    public function affiche()
    {
        $stmt = $this->pdo->query("SELECT * FROM Type");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function nombrePokemonsParType()
    {
        $stmt = $this->pdo->query("SELECT Type.name AS type, COUNT(pt.id_pokemon) AS nbr_pokemons FROM Type LEFT JOIN Pokemon_Type pt ON Type.id = pt.id_type GROUP BY Type.name ORDER BY nbr_pokemons DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>