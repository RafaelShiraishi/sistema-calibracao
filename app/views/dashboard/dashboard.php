<?php

require_once __DIR__ . '/../../../config/database.php';

$pdo = Database::conectar();


// ============================================================
// CONTADORES DO DASHBOARD
// ============================================================

// Equipamentos ativos
$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM equipamentos
    WHERE ativo = 1
");

$totalEquipamentos = (int) $stmt->fetchColumn();


// Calibrações cadastradas
$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM calibracoes
");

$totalCalibracoes = (int) $stmt->fetchColumn();


// Laboratórios ativos
$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM laboratorios
    WHERE ativo = 1
");

$totalLaboratorios = (int) $stmt->fetchColumn();


// Usuários
// A tabela usuarios atualmente não possui campo "ativo",
// então contamos todos os usuários cadastrados.
$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM usuarios
");

$totalUsuarios = (int) $stmt->fetchColumn();

?>

<h2 class="mb-4">
    Dashboard
</h2>

<div class="row">

    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Equipamentos</h6>

                <h2><?= $totalEquipamentos ?></h2>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Calibrações</h6>

                <h2><?= $totalCalibracoes ?></h2>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Laboratórios</h6>

                <h2><?= $totalLaboratorios ?></h2>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Usuários</h6>

                <h2><?= $totalUsuarios ?></h2>

            </div>

        </div>

    </div>

</div>


<div class="card shadow-sm mt-4">

    <div class="card-body">

        <h4>

            Bem-vindo,

            <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>

        </h4>

        <p>

            Sistema de Gestão de Calibração - Colormaq

        </p>

    </div>

</div>