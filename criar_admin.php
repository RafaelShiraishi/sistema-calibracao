<?php

require_once 'config/database.php';

$pdo = Database::conectar();

$nome = 'Administrador';
$email = 'admin@calibracao.com';
$senha = '123456';

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {

    // Verifica se o usuário já existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        echo "⚠️ Usuário já existe!";
        exit;
    }

    // Cria o administrador
    $stmt = $pdo->prepare("
        INSERT INTO usuarios
        (
            perfil_id,
            nome,
            email,
            senha,
            ativo
        )
        VALUES
        (
            ?, ?, ?, ?, ?
        )
    ");

    $stmt->execute([
        1,
        $nome,
        $email,
        $senhaHash,
        1
    ]);

    echo "✅ Administrador criado com sucesso!";

} catch (PDOException $e) {

    echo "❌ Erro: " . $e->getMessage();

}