<?php

require_once 'config/database.php';

$pdo = Database::conectar();

$tabelas = $pdo->query("SHOW TABLES");

echo "<pre>";

foreach ($tabelas as $linha) {
    print_r($linha);
}

echo "</pre>";