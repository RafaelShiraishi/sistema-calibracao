<?php

require_once __DIR__ . '/config/database.php';

try {
    $stmt = $pdo->query("SELECT 1 AS ok");
    $linha = $stmt->fetch();

    echo "<h1>Conexão com o banco OK</h1>";
    echo "<p>Resultado: " . $linha['ok'] . "</p>";
    echo "<p>PHP funcionando na Railway.</p>";

} catch (Throwable $e) {
    echo "<h1>Erro no teste</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}