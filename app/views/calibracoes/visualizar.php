<?php

$calibracao = $calibracao ?? [];

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                <i class="bi bi-clipboard-check"></i>
                Detalhes da Calibração
            </h2>

            <p class="text-muted mb-0">
                Visualização completa do registro de calibração.
            </p>

        </div>

        <a
            href="calibracoes.php"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>

    </div>


    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <strong>
                    <?= htmlspecialchars(
                        $calibracao['numero_certificado'] ?? '-'
                    ) ?>
                </strong>


                <?php

                $resultado =
                    $calibracao['resultado'] ?? '';

                $classeResultado = 'secondary';

                if ($resultado === 'Aprovado') {

                    $classeResultado = 'success';

                } elseif (
                    $resultado === 'Aprovado com Restrição'
                ) {

                    $classeResultado = 'warning';

                } elseif (
                    $resultado === 'Reprovado'
                ) {

                    $classeResultado = 'danger';

                }

                ?>

                <span class="badge bg-<?= $classeResultado ?>">

                    <?= htmlspecialchars($resultado) ?>

                </span>

            </div>

        </div>


        <div class="card-body">

            <div class="row">


                <div class="col-md-6 mb-4">

                    <label class="form-label text-muted">
                        Equipamento
                    </label>

                    <div class="fw-semibold">
                        <?= htmlspecialchars(
                            $calibracao['equipamento'] ?? '-'
                        ) ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="form-label text-muted">
                        Patrimônio
                    </label>

                    <div class="fw-semibold">
                        <?= htmlspecialchars(
                            $calibracao['patrimonio'] ?? '-'
                        ) ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="form-label text-muted">
                        TAG
                    </label>

                    <div class="fw-semibold">
                        <?= htmlspecialchars(
                            $calibracao['tag'] ?? '-'
                        ) ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="form-label text-muted">
                        Laboratório
                    </label>

                    <div class="fw-semibold">
                        <?= htmlspecialchars(
                            $calibracao['laboratorio'] ?? '-'
                        ) ?>
                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">
                        Data da Calibração
                    </label>

                    <div class="fw-semibold">

                        <?= !empty($calibracao['data_calibracao'])
                            ? date(
                                'd/m/Y',
                                strtotime(
                                    $calibracao['data_calibracao']
                                )
                            )
                            : '-'
                        ?>

                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">
                        Data de Validade
                    </label>

                    <div class="fw-semibold">

                        <?= !empty($calibracao['data_validade'])
                            ? date(
                                'd/m/Y',
                                strtotime(
                                    $calibracao['data_validade']
                                )
                            )
                            : '-'
                        ?>

                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <label class="form-label text-muted">
                        Status
                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $calibracao['status'] ?? '-'
                        ) ?>

                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="form-label text-muted">
                        Responsável
                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $calibracao['usuario'] ?? '-'
                        ) ?>

                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="form-label text-muted">
                        Incerteza
                    </label>

                    <div class="fw-semibold">

                        <?= htmlspecialchars(
                            $calibracao['incerteza'] ?? '-'
                        ) ?>

                    </div>

                </div>


                <div class="col-12 mb-4">

                    <label class="form-label text-muted">
                        Observações
                    </label>

                    <div class="border rounded p-3 bg-light">

                        <?= nl2br(
                            htmlspecialchars(
                                $calibracao['observacoes'] ?? '-'
                            )
                        ) ?>

                    </div>

                </div>


                <?php if (!empty($calibracao['certificado_pdf'])): ?>

                    <div class="col-12">

                        <a
                            href="<?= htmlspecialchars(
                                $calibracao['certificado_pdf']
                            ) ?>"
                            target="_blank"
                            class="btn btn-danger"
                        >

                            <i class="bi bi-file-earmark-pdf"></i>

                            Visualizar Certificado PDF

                        </a>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>