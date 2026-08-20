<?php

require_once 'config/database.php';

try {

    $pdo = Database::conectar();

    // ============================================================
    // FABRICANTES
    // ============================================================

    $pdo->exec("
        INSERT INTO fabricantes
            (nome, site, telefone, email, ativo)
        VALUES
            ('Fabricante de Teste', NULL, NULL, NULL, 1)
    ");


    // ============================================================
    // SETORES
    // ============================================================

    $pdo->exec("
        INSERT INTO setores
            (nome, descricao, ativo)
        VALUES
            ('Laboratório de Metrologia',
             'Setor responsável pelas atividades de metrologia e calibração.',
             1),

            ('Produção',
             'Setor de produção da empresa.',
             1),

            ('Qualidade',
             'Setor responsável pela qualidade.',
             1)
    ");


    // ============================================================
    // TIPOS DE EQUIPAMENTOS
    // ============================================================

    $pdo->exec("
        INSERT INTO tipos_equipamentos
            (nome, descricao, ativo)
        VALUES
            ('Instrumento de Medição',
             'Instrumentos utilizados para medições.',
             1),

            ('Paquímetro',
             'Instrumento para medição de dimensões.',
             1),

            ('Micrômetro',
             'Instrumento para medições de alta precisão.',
             1),

            ('Balança',
             'Equipamento utilizado para medição de massa.',
             1)
    ");


    // ============================================================
    // EMPRESA
    // ============================================================

    $pdo->exec("
        INSERT INTO empresas
            (
                razao_social,
                nome_fantasia,
                cnpj,
                telefone,
                email,
                endereco,
                cidade,
                estado,
                ativo
            )
        VALUES
            (
                'Empresa de Teste',
                'Empresa de Teste',
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                1
            )
    ");


    // ============================================================
    // STATUS
    // ============================================================

    $pdo->exec("
        INSERT INTO status_equipamentos
            (nome, descricao, ativo)
        VALUES
            ('Ativo',
             'Equipamento disponível para utilização.',
             1),

            ('Em Manutenção',
             'Equipamento temporariamente indisponível para manutenção.',
             1),

            ('Inativo',
             'Equipamento não está disponível para utilização.',
             1),

            ('Em Calibração',
             'Equipamento enviado para processo de calibração.',
             1)
    ");


    echo "<h2>✅ Dados básicos cadastrados com sucesso!</h2>";

    echo "<ul>";
    echo "<li>Fabricante: 1</li>";
    echo "<li>Setores: 3</li>";
    echo "<li>Tipos de equipamento: 4</li>";
    echo "<li>Empresa: 1</li>";
    echo "<li>Status: 4</li>";
    echo "</ul>";


} catch (PDOException $e) {

    echo "<h2 style='color:red;'>❌ Erro ao cadastrar os dados</h2>";

    echo "<pre>";
    echo htmlspecialchars($e->getMessage());
    echo "</pre>";
}