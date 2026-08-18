<?php

try {
    $pdo = new PDO(
        "mysql:host=mysql;dbname=sistema_calibracao;charset=utf8mb4",
        "usuario",
        "senha123"
    );

    echo "✅ Conectado ao MySQL com sucesso!";

} catch (PDOException $e) {
    echo "❌ Erro: " . $e->getMessage();
}