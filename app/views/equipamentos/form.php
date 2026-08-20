<?php

$modoEdicao = $modoEdicao ?? false;

$equipamento = $equipamento ?? [];

$fabricantes = $fabricantes ?? [];
$tipos = $tipos ?? [];
$setores = $setores ?? [];
$usuarios = $usuarios ?? [];
$empresas = $empresas ?? [];
$status = $status ?? [];
$laboratorios = $laboratorios ?? [];

$manutencoes = $manutencoes ?? [];

$calibracoes = $calibracoes ?? [];

$historico = $historico ?? [];

$ultimaCalibracao =
    $ultimaCalibracao
    ?? ($equipamento['ultima_calibracao'] ?? null);


$erroEquipamento =
    $_SESSION['erro_equipamento']
    ?? null;

$sucessoEquipamento =
    $_SESSION['sucesso_equipamento']
    ?? null;


unset(
    $_SESSION['erro_equipamento'],
    $_SESSION['sucesso_equipamento']
);


$titulo = $modoEdicao
    ? 'Editar Equipamento'
    : 'Novo Equipamento';


$subtitulo = $modoEdicao
    ? 'Atualize os dados do equipamento'
    : 'Cadastre um novo equipamento';

?>

<div class="card shadow-sm border-0">

    <!-- ====================================================== -->
    <!-- CABEÇALHO -->
    <!-- ====================================================== -->

    <div class="card-header bg-white">

        <h5 class="mb-1">

            <i class="bi bi-hdd-stack"></i>

            <?= htmlspecialchars($titulo) ?>

        </h5>

        <small class="text-muted">

            <?= htmlspecialchars($subtitulo) ?>

        </small>

    </div>


    <!-- ====================================================== -->
    <!-- MENSAGENS -->
    <!-- ====================================================== -->

    <?php if ($erroEquipamento): ?>

        <div class="alert alert-danger m-3 mb-0">

            <i class="bi bi-exclamation-triangle"></i>

            <?= htmlspecialchars($erroEquipamento) ?>

        </div>

    <?php endif; ?>


    <?php if ($sucessoEquipamento): ?>

        <div class="alert alert-success m-3 mb-0">

            <i class="bi bi-check-circle"></i>

            <?= htmlspecialchars($sucessoEquipamento) ?>

        </div>

    <?php endif; ?>


    <!-- ====================================================== -->
    <!-- ABAS -->
    <!-- ====================================================== -->

    <div class="card-header bg-white border-top">

        <ul
            class="nav nav-tabs card-header-tabs"
            id="equipamentoTabs"
            role="tablist"
        >

            <!-- GERAL -->

            <li class="nav-item" role="presentation">

                <button
                    type="button"
                    class="nav-link active"
                    data-bs-toggle="tab"
                    data-bs-target="#aba-geral"
                    role="tab"
                >

                    <i class="bi bi-info-circle"></i>

                    Geral

                </button>

            </li>


            <!-- CALIBRAÇÃO -->

            <li class="nav-item" role="presentation">

                <button
                    type="button"
                    class="nav-link"
                    data-bs-toggle="tab"
                    data-bs-target="#aba-calibracao"
                    role="tab"
                >

                    <i class="bi bi-clipboard-check"></i>

                    Calibração

                </button>

            </li>


            <!-- MANUTENÇÃO -->

            <li class="nav-item" role="presentation">

                <button
                    type="button"
                    class="nav-link"
                    data-bs-toggle="tab"
                    data-bs-target="#aba-manutencao"
                    role="tab"
                >

                    <i class="bi bi-tools"></i>

                    Manutenção

                </button>

            </li>


            <!-- HISTÓRICO -->

            <li class="nav-item" role="presentation">

                <button
                    type="button"
                    class="nav-link"
                    data-bs-toggle="tab"
                    data-bs-target="#aba-historico"
                    role="tab"
                >

                    <i class="bi bi-clock-history"></i>

                    Histórico

                </button>

            </li>

        </ul>

    </div>


    <!-- ====================================================== -->
    <!-- CONTEÚDO DAS ABAS -->
    <!-- ====================================================== -->

    <div class="card-body">

        <div class="tab-content">


            <!-- ================================================== -->
            <!-- ABA GERAL -->
            <!-- ================================================== -->

            <div
                class="tab-pane fade show active"
                id="aba-geral"
                role="tabpanel"
            >

                <form
                    method="POST"
                    action="equipamentos.php"
                >

                    <?php if (
                        $modoEdicao
                        &&
                        !empty($equipamento['id'])
                    ): ?>

                        <input
                            type="hidden"
                            name="id"
                            value="<?= (int) $equipamento['id'] ?>"
                        >

                    <?php endif; ?>


                    <div class="row">


                        <!-- PATRIMÔNIO -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Patrimônio *
                            </label>

                            <input
                                type="text"
                                name="patrimonio"
                                class="form-control"
                                maxlength="50"
                                value="<?= htmlspecialchars(
                                    $equipamento['patrimonio'] ?? ''
                                ) ?>"
                                required
                            >

                        </div>


                        <!-- TAG -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                TAG *
                            </label>

                            <input
                                type="text"
                                name="tag"
                                class="form-control"
                                maxlength="50"
                                value="<?= htmlspecialchars(
                                    $equipamento['tag'] ?? ''
                                ) ?>"
                                required
                            >

                        </div>


                        <!-- NOME -->

                        <div class="col-md-8 mb-3">

                            <label class="form-label">
                                Nome do Equipamento *
                            </label>

                            <input
                                type="text"
                                name="nome"
                                class="form-control"
                                maxlength="150"
                                value="<?= htmlspecialchars(
                                    $equipamento['nome'] ?? ''
                                ) ?>"
                                required
                            >

                        </div>


                        <!-- MODELO -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Modelo
                            </label>

                            <input
                                type="text"
                                name="modelo"
                                class="form-control"
                                maxlength="100"
                                value="<?= htmlspecialchars(
                                    $equipamento['modelo'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- FABRICANTE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Fabricante *
                            </label>

                            <select
                                name="fabricante"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Selecione...
                                </option>

                                <?php foreach (
                                    $fabricantes
                                    as $fabricante
                                ): ?>

                                    <option
                                        value="<?= (int) $fabricante['id'] ?>"
                                        <?= (
                                            (int) (
                                                $equipamento['fabricante_id']
                                                ?? 0
                                            )
                                            ===
                                            (int) $fabricante['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $fabricante['nome']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- TIPO -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tipo de Equipamento *
                            </label>

                            <select
                                name="tipo"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Selecione...
                                </option>

                                <?php foreach (
                                    $tipos
                                    as $tipo
                                ): ?>

                                    <option
                                        value="<?= (int) $tipo['id'] ?>"
                                        <?= (
                                            (int) (
                                                $equipamento['tipo_id']
                                                ?? 0
                                            )
                                            ===
                                            (int) $tipo['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $tipo['nome']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- NÚMERO DE SÉRIE -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Número de Série
                            </label>

                            <input
                                type="text"
                                name="serie"
                                class="form-control"
                                maxlength="100"
                                value="<?= htmlspecialchars(
                                    $equipamento['numero_serie'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- FAIXA -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Faixa de Medição
                            </label>

                            <input
                                type="text"
                                name="faixa"
                                class="form-control"
                                maxlength="100"
                                value="<?= htmlspecialchars(
                                    $equipamento['faixa_medicao'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- RESOLUÇÃO -->

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Resolução
                            </label>

                            <input
                                type="text"
                                name="resolucao"
                                class="form-control"
                                maxlength="100"
                                value="<?= htmlspecialchars(
                                    $equipamento['resolucao'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- SETOR -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Setor *
                            </label>

                            <select
                                name="setor"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Selecione...
                                </option>

                                <?php foreach (
                                    $setores
                                    as $setor
                                ): ?>

                                    <option
                                        value="<?= (int) $setor['id'] ?>"
                                        <?= (
                                            (int) (
                                                $equipamento['setor_id']
                                                ?? 0
                                            )
                                            ===
                                            (int) $setor['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $setor['nome']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- RESPONSÁVEL -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Responsável *
                            </label>

                            <select
                                name="responsavel"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Selecione...
                                </option>

                                <?php foreach (
                                    $usuarios
                                    as $usuario
                                ): ?>

                                    <option
                                        value="<?= (int) $usuario['id'] ?>"
                                        <?= (
                                            (int) (
                                                $equipamento['responsavel_id']
                                                ?? 0
                                            )
                                            ===
                                            (int) $usuario['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $usuario['nome']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- EMPRESA -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Empresa *
                            </label>

                            <select
                                name="empresa"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Selecione...
                                </option>

                                <?php foreach (
                                    $empresas
                                    as $empresa
                                ): ?>

                                    <option
                                        value="<?= (int) $empresa['id'] ?>"
                                        <?= (
                                            (int) (
                                                $equipamento['empresa_id']
                                                ?? 0
                                            )
                                            ===
                                            (int) $empresa['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $empresa['razao_social']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- STATUS -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Status *
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Selecione...
                                </option>

                                <?php foreach (
                                    $status
                                    as $st
                                ): ?>

                                    <option
                                        value="<?= (int) $st['id'] ?>"
                                        <?= (
                                            (int) (
                                                $equipamento['status_id']
                                                ?? 0
                                            )
                                            ===
                                            (int) $st['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $st['nome']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- LOCALIZAÇÃO -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Localização
                            </label>

                            <input
                                type="text"
                                name="localizacao"
                                class="form-control"
                                maxlength="150"
                                value="<?= htmlspecialchars(
                                    $equipamento['localizacao'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- DATA DE AQUISIÇÃO -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Data de Aquisição
                            </label>

                            <input
                                type="date"
                                name="data"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $equipamento['data_aquisicao'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- OBSERVAÇÕES -->

                        <div class="col-12 mb-3">

                            <label class="form-label">
                                Observações
                            </label>

                            <textarea
                                name="observacoes"
                                rows="5"
                                class="form-control"
                            ><?= htmlspecialchars(
                                $equipamento['observacoes'] ?? ''
                            ) ?></textarea>

                        </div>

                    </div>


                    <hr>


                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-success"
                        >

                            <i class="bi bi-check-circle"></i>

                            <?= $modoEdicao
                                ? 'Atualizar Equipamento'
                                : 'Cadastrar Equipamento'
                            ?>

                        </button>


                        <a
                            href="equipamentos.php"
                            class="btn btn-secondary"
                        >

                            <i class="bi bi-x-circle"></i>

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>


            <!-- ================================================== -->
            <!-- ABA CALIBRAÇÃO -->
            <!-- ================================================== -->

            <div
                class="tab-pane fade"
                id="aba-calibracao"
                role="tabpanel"
            >

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="mb-1">

                            <i class="bi bi-clipboard-check"></i>

                            Calibração

                        </h5>

                        <small class="text-muted">

                            Última calibração registrada para este equipamento.

                        </small>

                    </div>


                    <?php if ($modoEdicao && !empty($equipamento['id'])): ?>

                        <a
                            href="calibracoes.php?acao=novo&equipamento_id=<?= (int) $equipamento['id'] ?>"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-plus-circle"></i>

                            Nova Calibração

                        </a>

                    <?php endif; ?>

                </div>


                <?php if ($ultimaCalibracao): ?>


                    <?php

                    $resultado =
                        $ultimaCalibracao['resultado']
                        ?? '';

                    if (
                        $resultado === 'Aprovado'
                    ) {

                        $classeResultado = 'success';

                    } elseif (
                        $resultado ===
                        'Aprovado com Restrição'
                    ) {

                        $classeResultado = 'warning';

                    } else {

                        $classeResultado = 'danger';
                    }

                    ?>


                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <strong>
                                        Última calibração
                                    </strong>

                                    <div class="small text-muted">

                                        Registrada em

                                        <?= !empty(
                                            $ultimaCalibracao['data_calibracao']
                                        )
                                            ? date(
                                                'd/m/Y',
                                                strtotime(
                                                    $ultimaCalibracao['data_calibracao']
                                                )
                                            )
                                            : '-'
                                        ?>

                                    </div>

                                </div>


                                <span
                                    class="badge bg-<?= $classeResultado ?>"
                                >

                                    <?= htmlspecialchars(
                                        $resultado
                                    ) ?>

                                </span>

                            </div>

                        </div>


                        <div class="card-body">

                            <div class="row">


                                <div class="col-md-4 mb-3">

                                    <label class="form-label text-muted">

                                        Data da Calibração

                                    </label>

                                    <div class="fw-semibold">

                                        <?= !empty(
                                            $ultimaCalibracao['data_calibracao']
                                        )
                                            ? date(
                                                'd/m/Y',
                                                strtotime(
                                                    $ultimaCalibracao['data_calibracao']
                                                )
                                            )
                                            : '-'
                                        ?>

                                    </div>

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label text-muted">

                                        Data de Validade

                                    </label>

                                    <div class="fw-semibold">

                                        <?= !empty(
                                            $ultimaCalibracao['data_validade']
                                        )
                                            ? date(
                                                'd/m/Y',
                                                strtotime(
                                                    $ultimaCalibracao['data_validade']
                                                )
                                            )
                                            : '-'
                                        ?>

                                    </div>

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label text-muted">

                                        Número do Certificado

                                    </label>

                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $ultimaCalibracao['numero_certificado']
                                            ?? '-'
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label text-muted">

                                        Laboratório

                                    </label>

                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $ultimaCalibracao['laboratorio']
                                            ?? '-'
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label text-muted">

                                        Responsável pelo Registro

                                    </label>

                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $ultimaCalibracao['usuario']
                                            ?? '-'
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label text-muted">

                                        Incerteza de Medição

                                    </label>

                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $ultimaCalibracao['incerteza']
                                            ?? '-'
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label text-muted">

                                        Status da Calibração

                                    </label>

                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $ultimaCalibracao['status_calibracao']
                                            ?? '-'
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-12 mb-3">

                                    <label class="form-label text-muted">

                                        Observações

                                    </label>

                                    <div class="border rounded p-3 bg-light">

                                        <?= nl2br(
                                            htmlspecialchars(
                                                $ultimaCalibracao['observacoes']
                                                ?? '-'
                                            )
                                        ) ?>

                                    </div>

                                </div>


                                <?php if (
                                    !empty(
                                        $ultimaCalibracao['certificado_pdf']
                                    )
                                ): ?>

                                    <div class="col-12">

                                        <a
                                            href="<?= htmlspecialchars(
                                                $ultimaCalibracao['certificado_pdf']
                                            ) ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-outline-danger"
                                        >

                                            <i class="bi bi-file-earmark-pdf"></i>

                                            Visualizar Certificado PDF

                                        </a>

                                    </div>

                                <?php endif; ?>


                            </div>

                        </div>

                    </div>

                <?php else: ?>

                    <div class="alert alert-warning">

                        <i class="bi bi-exclamation-circle"></i>

                        <strong>
                            Nenhuma calibração registrada.
                        </strong>

                        <br>

                        Este equipamento ainda não possui uma calibração cadastrada.

                    </div>


                    <?php if (
                        $modoEdicao
                        &&
                        !empty($equipamento['id'])
                    ): ?>

                        <a
                            href="calibracoes.php?acao=novo&equipamento_id=<?= (int) $equipamento['id'] ?>"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-plus-circle"></i>

                            Registrar Primeira Calibração

                        </a>

                    <?php endif; ?>

                <?php endif; ?>

            </div>


            <!-- ================================================== -->
            <!-- ABA MANUTENÇÃO -->
            <!-- ================================================== -->

            <div
                class="tab-pane fade"
                id="aba-manutencao"
                role="tabpanel"
            >

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="mb-1">

                            <i class="bi bi-tools"></i>

                            Manutenção

                        </h5>

                        <small class="text-muted">

                            Registre e consulte as manutenções deste equipamento.

                        </small>

                    </div>

                </div>


                <?php if (
                    $modoEdicao
                    &&
                    !empty($equipamento['id'])
                ): ?>


                    <!-- NOVA MANUTENÇÃO -->

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <strong>

                                Registrar Manutenção

                            </strong>

                        </div>


                        <div class="card-body">

                            <form
                                method="POST"
                                action="equipamentos.php"
                            >

                                <input
                                    type="hidden"
                                    name="acao"
                                    value="salvar_manutencao"
                                >


                                <input
                                    type="hidden"
                                    name="equipamento_id"
                                    value="<?= (int) $equipamento['id'] ?>"
                                >


                                <div class="row">


                                    <div class="col-md-8 mb-3">

                                        <label class="form-label">

                                            Descrição da Manutenção *

                                        </label>

                                        <input
                                            type="text"
                                            name="descricao_manutencao"
                                            class="form-control"
                                            placeholder="Ex.: Manutenção preventiva"
                                            required
                                        >

                                    </div>


                                    <div class="col-md-4 mb-3">

                                        <label class="form-label">

                                            Data *

                                        </label>

                                        <input
                                            type="date"
                                            name="data_manutencao"
                                            class="form-control"
                                            value="<?= date('Y-m-d') ?>"
                                            required
                                        >

                                    </div>


                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Responsável pelo Registro

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            value="<?= htmlspecialchars(
                                                $_SESSION['usuario']['nome']
                                                ?? 'Usuário'
                                            ) ?>"
                                            readonly
                                        >

                                    </div>


                                    <div class="col-12 mb-3">

                                        <label class="form-label">

                                            Observações

                                        </label>

                                        <textarea
                                            name="observacoes_manutencao"
                                            rows="4"
                                            class="form-control"
                                            placeholder="Informe detalhes da manutenção..."
                                        ></textarea>

                                    </div>

                                </div>


                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >

                                    <i class="bi bi-check-circle"></i>

                                    Registrar Manutenção

                                </button>

                            </form>

                        </div>

                    </div>


                    <!-- HISTÓRICO DE MANUTENÇÕES -->

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <strong>

                                Histórico de Manutenções

                            </strong>

                        </div>


                        <div class="card-body p-0">

                            <?php if (empty($manutencoes)): ?>

                                <div class="p-4 text-center text-muted">

                                    <i class="bi bi-tools fs-1 d-block mb-3"></i>

                                    Nenhuma manutenção registrada para este equipamento.

                                </div>

                            <?php else: ?>

                                <div class="table-responsive">

                                    <table class="table table-hover align-middle mb-0">

                                        <thead class="table-light">

                                            <tr>

                                                <th>
                                                    Data
                                                </th>

                                                <th>
                                                    Descrição
                                                </th>

                                                <th>
                                                    Responsável
                                                </th>

                                                <th>
                                                    Observações
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            <?php foreach (
                                                $manutencoes
                                                as $manutencao
                                            ): ?>

                                                <tr>

                                                    <td>

                                                        <?= !empty(
                                                            $manutencao['data_manutencao']
                                                        )
                                                            ? date(
                                                                'd/m/Y',
                                                                strtotime(
                                                                    $manutencao['data_manutencao']
                                                                )
                                                            )
                                                            : '-'
                                                        ?>

                                                    </td>


                                                    <td>

                                                        <strong>

                                                            <?= htmlspecialchars(
                                                                $manutencao['descricao']
                                                                ?? '-'
                                                            ) ?>

                                                        </strong>

                                                    </td>


                                                    <td>

                                                        <?= htmlspecialchars(
                                                            $manutencao['usuario']
                                                            ?? '-'
                                                        ) ?>

                                                    </td>


                                                    <td>

                                                        <?= nl2br(
                                                            htmlspecialchars(
                                                                $manutencao['observacoes']
                                                                ?? '-'
                                                            )
                                                        ) ?>

                                                    </td>

                                                </tr>

                                            <?php endforeach; ?>

                                        </tbody>

                                    </table>

                                </div>

                            <?php endif; ?>

                        </div>

                    </div>


                <?php else: ?>

                    <div class="alert alert-info">

                        <i class="bi bi-info-circle"></i>

                        Para registrar uma manutenção,
                        primeiro salve o equipamento.

                    </div>

                <?php endif; ?>

            </div>


            <!-- ================================================== -->
            <!-- ABA HISTÓRICO -->
            <!-- ================================================== -->

            <div
                class="tab-pane fade"
                id="aba-historico"
                role="tabpanel"
            >

                <div class="mb-4">

                    <h5 class="mb-1">

                        <i class="bi bi-clock-history"></i>

                        Histórico

                    </h5>

                    <small class="text-muted">

                        Histórico de calibrações, manutenções e ocorrências
                        deste equipamento.

                    </small>

                </div>


                <?php if (empty($historico)): ?>

                    <div class="alert alert-secondary">

                        <i class="bi bi-info-circle"></i>

                        Nenhum evento registrado para este equipamento.

                    </div>

                <?php else: ?>

                    <div class="card border-0 shadow-sm">

                        <div class="table-responsive">

                            <table
                                class="table table-hover align-middle mb-0"
                            >

                                <thead class="table-light">

                                    <tr>

                                        <th>
                                            Data
                                        </th>

                                        <th>
                                            Tipo
                                        </th>

                                        <th>
                                            Descrição
                                        </th>

                                        <th>
                                            Usuário
                                        </th>

                                        <th>
                                            Observações
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <?php foreach (
                                        $historico
                                        as $evento
                                    ): ?>

                                        <tr>

                                            <td>

                                                <?= !empty(
                                                    $evento['data_evento']
                                                )
                                                    ? date(
                                                        'd/m/Y',
                                                        strtotime(
                                                            $evento['data_evento']
                                                        )
                                                    )
                                                    : '-'
                                                ?>

                                            </td>


                                            <td>

                                                <?php if (
                                                    (
                                                        $evento['tipo_evento']
                                                        ?? ''
                                                    )
                                                    ===
                                                    'Calibração'
                                                ): ?>

                                                    <span
                                                        class="badge bg-primary"
                                                    >

                                                        <i
                                                            class="bi bi-clipboard-check"
                                                        ></i>

                                                        Calibração

                                                    </span>

                                                <?php elseif (
                                                    (
                                                        $evento['tipo_evento']
                                                        ?? ''
                                                    )
                                                    ===
                                                    'Manutenção'
                                                ): ?>

                                                    <span
                                                        class="badge bg-warning text-dark"
                                                    >

                                                        <i
                                                            class="bi bi-tools"
                                                        ></i>

                                                        Manutenção

                                                    </span>

                                                <?php else: ?>

                                                    <span
                                                        class="badge bg-secondary"
                                                    >

                                                        Ocorrência

                                                    </span>

                                                <?php endif; ?>

                                            </td>


                                            <td>

                                                <strong>

                                                    <?= htmlspecialchars(
                                                        $evento['descricao']
                                                        ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>


                                            <td>

                                                <?= htmlspecialchars(
                                                    $evento['usuario']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <td>

                                                <?= nl2br(
                                                    htmlspecialchars(
                                                        $evento['observacoes']
                                                        ?? '-'
                                                    )
                                                ) ?>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                <?php endif; ?>

            </div>


        </div>

    </div>

</div>