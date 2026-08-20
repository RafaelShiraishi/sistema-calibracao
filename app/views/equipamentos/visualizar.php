<?php

$equipamento = $equipamento ?? [];

$ultimaCalibracao =
    $ultimaCalibracao ?? null;

$manutencoes =
    $manutencoes ?? [];

$calibracoes =
    $calibracoes ?? [];

$historico =
    $historico ?? [];


$ativo =
    (int) (
        $equipamento['ativo'] ?? 1
    ) === 1;

?>

<div class="container-fluid">

    <!-- ====================================================== -->
    <!-- CABEÇALHO -->
    <!-- ====================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-hdd-stack"></i>

                Visualizar Equipamento

            </h2>

            <p class="text-muted mb-0">

                Detalhes completos do equipamento.

            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="equipamentos.php?acao=editar&id=<?= (int) ($equipamento['id'] ?? 0) ?>"
                class="btn btn-warning"
            >

                <i class="bi bi-pencil"></i>

                Editar

            </a>


            <a
                href="equipamentos.php"
                class="btn btn-outline-secondary"
            >

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- IDENTIFICAÇÃO -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="mb-1">

                        <?= htmlspecialchars(
                            $equipamento['nome']
                            ?? '-'
                        ) ?>

                    </h5>

                    <small class="text-muted">

                        Patrimônio:

                        <?= htmlspecialchars(
                            $equipamento['patrimonio']
                            ?? '-'
                        ) ?>

                    </small>

                </div>


                <div class="d-flex gap-2">

                    <?php if ($ativo): ?>

                        <span class="badge text-bg-success">

                            <i class="bi bi-check-circle"></i>

                            Ativo

                        </span>

                    <?php else: ?>

                        <span class="badge text-bg-secondary">

                            <i class="bi bi-pause-circle"></i>

                            Inativo

                        </span>

                    <?php endif; ?>


                    <?php if (!empty($equipamento['status'])): ?>

                        <span class="badge text-bg-primary">

                            <?= htmlspecialchars(
                                $equipamento['status']
                            ) ?>

                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>


        <div class="card-body">

            <div class="row">


                <!-- PATRIMÔNIO -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Patrimônio

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['patrimonio']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- TAG -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        TAG

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['tag']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- MODELO -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Modelo

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['modelo']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- FABRICANTE -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Fabricante

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['fabricante']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- TIPO -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Tipo

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['tipo']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- NÚMERO DE SÉRIE -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Número de Série

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['numero_serie']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- FAIXA -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Faixa de Medição

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['faixa_medicao']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- RESOLUÇÃO -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Resolução

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['resolucao']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- SETOR -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Setor

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['setor']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- RESPONSÁVEL -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Responsável

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['responsavel']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- EMPRESA -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Empresa

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['empresa']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- LOCALIZAÇÃO -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Localização

                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $equipamento['localizacao']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- DATA DE AQUISIÇÃO -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Data de Aquisição

                    </label>

                    <div class="fw-semibold">

                        <?= !empty(
                            $equipamento['data_aquisicao']
                        )
                            ? date(
                                'd/m/Y',
                                strtotime(
                                    $equipamento['data_aquisicao']
                                )
                            )
                            : '-'
                        ?>

                    </div>

                </div>


                <!-- DATA DE CADASTRO -->

                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">

                        Data de Cadastro

                    </label>

                    <div class="fw-semibold">

                        <?= !empty(
                            $equipamento['data_cadastro']
                        )
                            ? date(
                                'd/m/Y H:i',
                                strtotime(
                                    $equipamento['data_cadastro']
                                )
                            )
                            : '-'
                        ?>

                    </div>

                </div>


                <!-- OBSERVAÇÕES -->

                <div class="col-12">

                    <label class="form-label text-muted">

                        Observações

                    </label>

                    <div class="border rounded p-3 bg-light">

                        <?= nl2br(
                            htmlspecialchars(
                                $equipamento['observacoes']
                                ?? '-'
                            )
                        ) ?>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- ÚLTIMA CALIBRAÇÃO -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <strong>

                    <i class="bi bi-clipboard-check"></i>

                    Última Calibração

                </strong>


                <?php if (!empty($equipamento['id'])): ?>

                    <a
                        href="calibracoes.php?acao=novo&equipamento_id=<?= (int) $equipamento['id'] ?>"
                        class="btn btn-sm btn-primary"
                    >

                        <i class="bi bi-plus-circle"></i>

                        Nova Calibração

                    </a>

                <?php endif; ?>

            </div>

        </div>


        <div class="card-body">

            <?php if ($ultimaCalibracao): ?>


                <?php

                $resultado =
                    $ultimaCalibracao['resultado']
                    ?? '';

                $classeResultado =
                    'secondary';

                if (
                    $resultado === 'Aprovado'
                ) {

                    $classeResultado =
                        'success';

                } elseif (
                    $resultado ===
                    'Aprovado com Restrição'
                ) {

                    $classeResultado =
                        'warning';

                } elseif (
                    $resultado === 'Reprovado'
                ) {

                    $classeResultado =
                        'danger';
                }

                ?>


                <div class="row">


                    <div class="col-md-3 mb-3">

                        <label class="form-label text-muted">

                            Data

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


                    <div class="col-md-3 mb-3">

                        <label class="form-label text-muted">

                            Validade

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


                    <div class="col-md-3 mb-3">

                        <label class="form-label text-muted">

                            Certificado

                        </label>

                        <div class="fw-semibold">

                            <?= htmlspecialchars(
                                $ultimaCalibracao['numero_certificado']
                                ?? '-'
                            ) ?>

                        </div>

                    </div>


                    <div class="col-md-3 mb-3">

                        <label class="form-label text-muted">

                            Resultado

                        </label>

                        <div>

                            <span
                                class="badge bg-<?= $classeResultado ?>"
                            >

                                <?= htmlspecialchars(
                                    $resultado
                                ) ?>

                            </span>

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

                            Responsável

                        </label>

                        <div class="fw-semibold">

                            <?= htmlspecialchars(
                                $ultimaCalibracao['usuario']
                                ?? '-'
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


            <?php else: ?>

                <div class="alert alert-warning mb-0">

                    <i class="bi bi-exclamation-circle"></i>

                    Nenhuma calibração registrada para este equipamento.

                </div>

            <?php endif; ?>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- MANUTENÇÕES -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <strong>

                <i class="bi bi-tools"></i>

                Histórico de Manutenções

            </strong>

        </div>


        <div class="card-body p-0">

            <?php if (empty($manutencoes)): ?>

                <div class="p-4 text-center text-muted">

                    <i class="bi bi-tools fs-1 d-block mb-3"></i>

                    Nenhuma manutenção registrada.

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


    <!-- ====================================================== -->
    <!-- HISTÓRICO -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <strong>

                <i class="bi bi-clock-history"></i>

                Histórico do Equipamento

            </strong>

        </div>


        <div class="card-body p-0">

            <?php if (empty($historico)): ?>

                <div class="p-4 text-center text-muted">

                    <i class="bi bi-clock-history fs-1 d-block mb-3"></i>

                    Nenhum evento registrado.

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

                                        <?= htmlspecialchars(
                                            $evento['descricao']
                                            ?? '-'
                                        ) ?>

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

            <?php endif; ?>

        </div>

    </div>

</div>