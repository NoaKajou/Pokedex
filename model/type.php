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
}
?>