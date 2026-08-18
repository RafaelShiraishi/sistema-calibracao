<?php

$paginaAtual = basename($_SERVER['PHP_SELF']);

?>

<div class="sidebar">

    <h4>
        <i class="bi bi-tools"></i>
        <br>
        Sistema de Calibração
    </h4>

    <a
        href="dashboard.php"
        class="<?= $paginaAtual === 'dashboard.php' ? 'active' : '' ?>"
    >
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a
        href="equipamentos.php"
        class="<?= $paginaAtual === 'equipamentos.php' ? 'active' : '' ?>"
    >
        <i class="bi bi-hdd-stack"></i>
        Equipamentos
    </a>

    <a href="calibracoes.php">
        <i class="bi bi-clipboard2-check"></i>
        Calibrações
    </a>

    <a href="laboratorios.php">
        <i class="bi bi-building"></i>
        Laboratórios
    </a>

    <a href="usuarios.php">
        <i class="bi bi-people"></i>
        Usuários
    </a>

    <a href="relatorios.php">
        <i class="bi bi-file-earmark-bar-graph"></i>
        Relatórios
    </a>

    <a href="configuracoes.php">
        <i class="bi bi-gear"></i>
        Configurações
    </a>

    <hr class="text-light">

    <a href="logout.php">
        <i class="bi bi-box-arrow-right"></i>
        Sair
    </a>

</div>


<div class="content">

    <div class="topbar d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-0">
                Sistema de Gestão de Calibração
            </h4>

            <small class="text-muted">
                Colormaq - Araçatuba
            </small>

        </div>

        <div>

            <i class="bi bi-person-circle fs-4"></i>

            <strong class="ms-2">
                <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário') ?>
            </strong>

        </div>

    </div>