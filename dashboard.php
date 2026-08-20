<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: index.php");
    exit;

}

require_once 'config/database.php';

$pdo = Database::conectar();


// ============================================================
// CONTADORES DO DASHBOARD
// ============================================================

$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM equipamentos
    WHERE ativo = 1
");

$totalEquipamentos = (int) $stmt->fetchColumn();


$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM calibracoes
");

$totalCalibracoes = (int) $stmt->fetchColumn();


$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM laboratorios
    WHERE ativo = 1
");

$totalLaboratorios = (int) $stmt->fetchColumn();


$stmt = $pdo->query("
    SELECT COUNT(*)
    FROM usuarios
    WHERE ativo = 1
");

$totalUsuarios = (int) $stmt->fetchColumn();


include 'app/views/layouts/header.php';

include 'app/views/layouts/sidebar.php';

include 'app/views/dashboard/dashboard.php';

include 'app/views/layouts/footer.php';