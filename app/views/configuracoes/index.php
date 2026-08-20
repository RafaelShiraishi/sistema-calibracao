<?php

$usuario = $usuario ?? [];

?>

<div class="container-fluid">

    <!-- ====================================================== -->
    <!-- CABEÇALHO -->
    <!-- ====================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-gear"></i>

                Configurações

            </h2>

            <p class="text-muted mb-0">

                Configurações gerais e recursos administrativos
                do Sistema de Gestão de Calibração.

            </p>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- PERFIL -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-person-circle"></i>

                Meu Perfil

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label text-muted">
                        Nome
                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $usuario['nome'] ?? '-'
                        ) ?>

                    </div>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label text-muted">
                        E-mail
                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $usuario['email'] ?? '-'
                        ) ?>

                    </div>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label text-muted">
                        Perfil
                    </label>

                    <div>

                        <span class="badge text-bg-primary">

                            <?= htmlspecialchars(
                                $usuario['perfil']
                                ?? 'Administrador'
                            ) ?>

                        </span>

                    </div>

                </div>

            </div>


            <a
                href="usuarios.php?acao=editar&id=<?= (int) ($usuario['id'] ?? 0) ?>"
                class="btn btn-outline-primary"
            >

                <i class="bi bi-person-gear"></i>

                Editar meu perfil

            </a>

        </div>

    </div>


    <div class="row g-4">


        <!-- ================================================== -->
        <!-- ALERTAS -->
        <!-- ================================================== -->

        <div class="col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-bell"></i>

                        Alertas de Calibração

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Configure os parâmetros que serão utilizados
                        para identificar calibrações próximas do vencimento.

                    </p>


                    <div class="mb-3">

                        <label class="form-label">

                            Antecedência do alerta

                        </label>

                        <select
                            class="form-select"
                            disabled
                        >

                            <option>
                                30 dias
                            </option>

                            <option>
                                15 dias
                            </option>

                            <option>
                                7 dias
                            </option>

                        </select>

                        <div class="form-text">

                            A configuração persistente será implementada
                            junto com o módulo de alertas.

                        </div>

                    </div>


                    <div class="form-check form-switch">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            disabled
                            checked
                        >

                        <label class="form-check-label">

                            Alertas de calibração habilitados

                        </label>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================================================== -->
        <!-- USUÁRIOS -->
        <!-- ================================================== -->

        <div class="col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-people"></i>

                        Usuários e Permissões

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Gerencie usuários, perfis e níveis de acesso
                        ao sistema.

                    </p>


                    <a
                        href="usuarios.php"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-people"></i>

                        Gerenciar Usuários

                    </a>

                </div>

            </div>

        </div>


        <!-- ================================================== -->
        <!-- LABORATÓRIOS -->
        <!-- ================================================== -->

        <div class="col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-building"></i>

                        Laboratórios

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Cadastre e gerencie os laboratórios responsáveis
                        pelas calibrações.

                    </p>


                    <a
                        href="laboratorios.php"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-building"></i>

                        Gerenciar Laboratórios

                    </a>

                </div>

            </div>

        </div>


        <!-- ================================================== -->
        <!-- RELATÓRIOS -->
        <!-- ================================================== -->

        <div class="col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-file-earmark-bar-graph"></i>

                        Relatórios

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Consulte relatórios de equipamentos,
                        calibrações e manutenções.

                    </p>


                    <a
                        href="relatorios.php"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-bar-chart"></i>

                        Abrir Relatórios

                    </a>

                </div>

            </div>

        </div>


        <!-- ================================================== -->
        <!-- SEGURANÇA -->
        <!-- ================================================== -->

        <div class="col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-shield-check"></i>

                        Segurança

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Recursos relacionados à segurança,
                        permissões e controle de acesso.

                    </p>


                    <div class="d-flex flex-wrap gap-2">

                        <span class="badge text-bg-success">

                            <i class="bi bi-check-circle"></i>

                            Sessão ativa

                        </span>


                        <span class="badge text-bg-primary">

                            <i class="bi bi-person-lock"></i>

                            Controle de acesso

                        </span>

                    </div>

                    <div class="form-text mt-3">

                        A revisão completa de permissões e segurança
                        será realizada na etapa de segurança do sistema.

                    </div>

                </div>

            </div>

        </div>


        <!-- ================================================== -->
        <!-- BANCO E BACKUP -->
        <!-- ================================================== -->

        <div class="col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-database-check"></i>

                        Banco de Dados e Backup

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Recursos administrativos relacionados
                        ao banco de dados e backup do sistema.

                    </p>


                    <div class="alert alert-warning mb-0">

                        <i class="bi bi-info-circle"></i>

                        O procedimento de backup e restauração
                        será disponibilizado na etapa de produção.

                    </div>

                </div>

            </div>

        </div>


        <!-- ================================================== -->
        <!-- SISTEMA -->
        <!-- ================================================== -->

        <div class="col-12">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-info-circle"></i>

                        Informações do Sistema

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label text-muted">

                                Sistema

                            </label>

                            <div class="fw-semibold">

                                Sistema de Gestão de Calibração

                            </div>

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label text-muted">

                                Empresa

                            </label>

                            <div class="fw-semibold">

                                Colormaq - Araçatuba

                            </div>

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label text-muted">

                                Ambiente

                            </label>

                            <div>

                                <span class="badge text-bg-success">

                                    Desenvolvimento

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>