<?php
require_once (__DIR__ . '/../controller/pdo_controller.php');
require_once 'pdo.php';

class Generation
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new Database();
        $this->pdo = $this->pdo->getConnection();
    }
    public function affiche()
    {
        $stmt = $this->pdo->query("SELECT * FROM Generation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>