<?php

try {
    $pdo = new PDO(
        "mysql:host=mysql;charset=utf8mb4",
        "usuario",
        "senha123"
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents(__DIR__ . "/sql/banco.sql");

    $pdo->exec($sql);

    echo "<h2>✅ Banco importado com sucesso!</h2>";

} catch (PDOException $e) {
    die("<h2>❌ Erro:</h2>" . $e->getMessage());
}