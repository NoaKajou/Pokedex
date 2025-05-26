<?php
require_once 'pdo_controller.php';
require_once (__DIR__ . '/../model/generation.php');

class GenerationController 
{
    private $pdo;
    public function getAllGenerations()
    {
        $gen = new Generation($this->pdo);
        return $gen->affiche();
    }
}
?>