<?php

$paginaAtual = basename($_SERVER['PHP_SELF']);

?>

<div class="sidebar">

    <h4>
        <i class="bi bi-tools"></i>
        <br>
        Sistema de Calibração
    </h4>


    <!-- ====================================================== -->
    <!-- DASHBOARD -->
    <!-- ====================================================== -->

    <a
        href="dashboard.php"
        class="<?= $paginaAtual === 'dashboard.php' ? 'active' : '' ?>"
    >

        <i class="bi bi-speedometer2"></i>

        Dashboard

    </a>


    <!-- ====================================================== -->
    <!-- EQUIPAMENTOS -->
    <!-- ====================================================== -->

    <a
        href="equipamentos.php"
        class="<?= $paginaAtual === 'equipamentos.php' ? 'active' : '' ?>"
    >

        <i class="bi bi-hdd-stack"></i>

        Equipamentos

    </a>


    <!-- ====================================================== -->
    <!-- CALIBRAÇÕES -->
    <!-- ====================================================== -->

    <a
        href="calibracoes.php"
        class="<?= $paginaAtual === 'calibracoes.php' ? 'active' : '' ?>"
    >

        <i class="bi bi-clipboard2-check"></i>

        Calibrações

    </a>


    <!-- ====================================================== -->
    <!-- LABORATÓRIOS -->
    <!-- ====================================================== -->

    <a
        href="laboratorios.php"
        class="<?= $paginaAtual === 'laboratorios.php' ? 'active' : '' ?>"
    >

        <i class="bi bi-building"></i>

        Laboratórios

    </a>


    <!-- ====================================================== -->
    <!-- USUÁRIOS -->
    <!-- ====================================================== -->

    <a
        href="usuarios.php"
        class="<?= $paginaAtual === 'usuarios.php' ? 'active' : '' ?>"
    >

        <i class="bi bi-people"></i>

        Usuários

    </a>


    <!-- ====================================================== -->
    <!-- RELATÓRIOS -->
    <!-- ====================================================== -->

    <a
        href="relatorios.php"
        class="<?= $paginaAtual === 'relatorios.php' ? 'active' : '' ?>"
    >

        <i class="bi bi-file-earmark-bar-graph"></i>

        Relatórios

    </a>


    <!-- ====================================================== -->
    <!-- CONFIGURAÇÕES -->
    <!-- ====================================================== -->

    <a
        href="configuracoes.php"
        class="<?= $paginaAtual === 'configuracoes.php' ? 'active' : '' ?>"
    >

        <i class="bi bi-gear"></i>

        Configurações

    </a>


    <hr class="text-light">


    <!-- ====================================================== -->
    <!-- SAIR -->
    <!-- ====================================================== -->

    <a href="logout.php">

        <i class="bi bi-box-arrow-right"></i>

        Sair

    </a>

</div>


<div class="content">


    <!-- ====================================================== -->
    <!-- TOPBAR -->
    <!-- ====================================================== -->

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

                <?= htmlspecialchars(
                    $_SESSION['usuario']['nome']
                    ?? 'Usuário'
                ) ?>

            </strong>

        </div>

    </div>