<?php

require_once 'config/database.php';

$pdo = Database::conectar();

try {

    $stmt = $pdo->query("
        SELECT
            u.id,
            u.nome,
            u.email,
            p.nome AS perfil,
            u.ativo
        FROM usuarios u
        INNER JOIN perfis p
            ON p.id = u.perfil_id
    ");

    echo "<pre>";
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
    echo "</pre>";

} catch (PDOException $e) {

    echo "Erro: " . $e->getMessage();

}