<?php

require_once 'config/database.php';

$pdo = Database::conectar();

try {

    $sql = "
    INSERT INTO perfis (nome, descricao) VALUES
    ('Administrador', 'Acesso total ao sistema'),
    ('Metrologista', 'Responsável pelas calibrações'),
    ('Técnico', 'Responsável pelos equipamentos'),
    ('Gestor', 'Gerencia relatórios e usuários');
    ";

    $pdo->exec($sql);

    echo "✅ Perfis cadastrados com sucesso!";

} catch (PDOException $e) {

    echo "❌ Erro: " . $e->getMessage();

}