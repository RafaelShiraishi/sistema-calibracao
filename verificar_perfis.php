<?php

require_once 'config/database.php';

$pdo = Database::conectar();

$stmt = $pdo->query("SELECT * FROM perfis");

echo "<pre>";

print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

echo "</pre>";