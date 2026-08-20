<?php

require_once 'config/database.php';

try {

    // ============================================================
    // CONEXÃO COM O BANCO
    // ============================================================

    $pdo = Database::conectar();


    // ============================================================
    // VERIFICA SE A TABELA USUARIOS EXISTE
    // ============================================================

    $consulta = $pdo->query("
        SHOW TABLES LIKE 'usuarios'
    ");

    $usuariosExiste = $consulta->fetchColumn();


    if ($usuariosExiste) {

        echo "<h2>✅ Conexão com o banco realizada com sucesso!</h2>";

        echo "<p>";
        echo "A tabela <strong>usuarios</strong> já existe no banco.";
        echo "</p>";

        echo "<p>";
        echo "Nenhuma alteração foi feita nessa tabela.";
        echo "</p>";

    } else {

        echo "<h2>⚠️ A tabela usuarios não foi encontrada.</h2>";

        echo "<p>";
        echo "A tabela usuarios precisa ser criada de acordo com a estrutura atual do sistema.";
        echo "</p>";

    }


} catch (PDOException $e) {

    echo "<h2 style='color:red;'>❌ Erro na conexão com o banco</h2>";

    echo "<pre>";
    echo htmlspecialchars($e->getMessage());
    echo "</pre>";

}