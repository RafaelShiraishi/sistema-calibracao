<?php

require_once 'config/database.php';

$pdo = Database::conectar();

$nome = 'Laboratório Colormaq';

$sql = "
    INSERT INTO laboratorios
    (
        nome,
        ativo
    )
    VALUES
    (
        :nome,
        1
    )
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nome' => $nome
]);

echo "Laboratório cadastrado com sucesso: {$nome}" . PHP_EOL;