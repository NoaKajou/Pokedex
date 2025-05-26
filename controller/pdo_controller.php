<?php
require_once(__DIR__ . '/../model/pdo.php');

$database = new Database();
$pdo = $database->getConnection();
?>