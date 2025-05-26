<?php
require_once 'pdo_controller.php';
require_once (__DIR__ . '/../model/pokemon_type.php');

class PokemonTypeController
{
    private $pdo;
    public function getAllTypes()
    {
        $pokemonType = new Pokemon_Type($this->pdo);
        return $pokemonType->affiche();
    }

    public function getPokemonByType($typeId)
    {
        $pokemonType = new Pokemon_Type($this->pdo);
        return $pokemonType->getPokemonByType($typeId);
    }

    public function getTypesByPokemon($pokemonId)
    {
        $pokemonType = new Pokemon_Type($this->pdo);
        return $pokemonType->getTypesByPokemon($pokemonId);
    }
}