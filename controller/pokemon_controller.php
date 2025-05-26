<?php
require_once 'pdo_controller.php';
require_once (__DIR__ . '/../model/pokemon.php');

class PokemonController
{
    private $pdo;
    public function getAllPokemons()
    {
        $pokemon = new Pokemon($this->pdo);
        return $pokemon->affiche();
    }
    public function getPokemonById($id)
    {
        $pokemon = new Pokemon($this->pdo);
        return $pokemon->affichePokemon($id); // Passe l'ID ici
    }
    public function getPokemonsByGeneration($id_gen)
    {
        $pokemon = new Pokemon($this->pdo);
        return $pokemon->afficheGeneration($id_gen);
    }
    public function addPokemon($numero, $name, $weight, $height, $sexe, $talent, $legendary, $id_gen, $image)
    {
        $pokemon = new Pokemon($this->pdo);
        return $pokemon->ajouterPokemon($numero, $name, $weight, $height, $sexe, $talent, $legendary, $id_gen, $image);
    }
}
?>