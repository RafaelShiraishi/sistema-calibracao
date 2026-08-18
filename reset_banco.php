<?php

require_once 'config/database.php';

$pdo = Database::conectar();

try {

    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

    $tabelas = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tabelas as $tabela) {
        $pdo->exec("DROP TABLE `$tabela`");
        echo "Tabela $tabela removida.<br>";
    }

    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    echo "<br>✅ Banco limpo com sucesso.";

} catch (PDOException $e) {

    echo $e->getMessage();

}