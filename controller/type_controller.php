<?php
require_once 'pdo_controller.php';
require_once (__DIR__ . '/../model/type.php');

class TypeController
{
    private $pdo;
    public function getAllTypes()
    {
        $type = new Type($this->pdo);
        return $type->affiche();
    }
    public function getNbr()
    {
        $type = new Type($this->pdo);
        return $type->nombrePokemonsParType();
    }
}
?>