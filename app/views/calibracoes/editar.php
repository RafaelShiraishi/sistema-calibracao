<?php

$calibracao = $calibracao ?? [];

$equipamentos = $equipamentos ?? [];

$laboratorios = $laboratorios ?? [];

$usuarios = $usuarios ?? [];

$status = $status ?? [];

$erro = $_SESSION['erro_calibracao'] ?? null;

unset($_SESSION['erro_calibracao']);

?>

$calibracao = $calibracao ?? [];

$erro = $_SESSION['erro_calibracao'] ?? null;

unset($_SESSION['erro_calibracao']);

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                <i class="bi bi-pencil-square"></i>
                Editar Calibração
            </h2>

            <p class="text-muted mb-0">
                Atualize os dados da calibração.
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


    <?php if ($erro): ?>

        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i>
            <?= htmlspecialchars($erro) ?>
        </div>

    <?php endif; ?>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form
                method="POST"
                action="calibracoes.php"
                enctype="multipart/form-data"
            >

                <input
                    type="hidden"
                    name="acao"
                    value="editar"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= (int) ($calibracao['id'] ?? 0) ?>"
                >


                <div class="row">

                    <!-- EQUIPAMENTO -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Equipamento *
                        </label>

                        <select
                            name="equipamento_id"
                            class="form-select"
                            required
                        >

                            <?php foreach ($equipamentos as $equipamento): ?>

                                <option
                                    value="<?= (int) $equipamento['id'] ?>"
                                    <?= (
                                        (int) $calibracao['equipamento_id']
                                        ===
                                        (int) $equipamento['id']
                                    )
                                        ? 'selected'
                                        : ''
                                    ?>
                                >

                                    <?= htmlspecialchars(
                                        $equipamento['nome']
                                    ) ?>

                                    -
                                    <?= htmlspecialchars(
                                        $equipamento['patrimonio']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- LABORATÓRIO -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Laboratório *
                        </label>

                        <select
                            name="laboratorio_id"
                            class="form-select"
                            required
                        >

                            <?php foreach ($laboratorios as $laboratorio): ?>

                                <option
                                    value="<?= (int) $laboratorio['id'] ?>"
                                    <?= (
                                        (int) $calibracao['laboratorio_id']
                                        ===
                                        (int) $laboratorio['id']
                                    )
                                        ? 'selected'
                                        : ''
                                    ?>
                                >

                                    <?= htmlspecialchars(
                                        $laboratorio['nome']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- CERTIFICADO -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Número do Certificado *
                        </label>

                        <input
                            type="text"
                            name="numero_certificado"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $calibracao['numero_certificado'] ?? ''
                            ) ?>"
                            required
                        >

                    </div>


                    <!-- RESULTADO -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Resultado *
                        </label>

                        <select
                            name="resultado"
                            class="form-select"
                            required
                        >

                            <?php
                            $resultados = [
                                'Aprovado',
                                'Aprovado com Restrição',
                                'Reprovado'
                            ];
                            ?>

                            <?php foreach ($resultados as $resultado): ?>

                                <option
                                    value="<?= htmlspecialchars($resultado) ?>"
                                    <?= (
                                        ($calibracao['resultado'] ?? '')
                                        ===
                                        $resultado
                                    )
                                        ? 'selected'
                                        : ''
                                    ?>
                                >

                                    <?= htmlspecialchars($resultado) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- DATA CALIBRAÇÃO -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Data da Calibração *
                        </label>

                        <input
                            type="date"
                            name="data_calibracao"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $calibracao['data_calibracao'] ?? ''
                            ) ?>"
                            required
                        >

                    </div>


                    <!-- DATA VALIDADE -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Data de Validade *
                        </label>

                        <input
                            type="date"
                            name="data_validade"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $calibracao['data_validade'] ?? ''
                            ) ?>"
                            required
                        >

                    </div>


                    <!-- INCERTEZA -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Incerteza de Medição
                        </label>

                        <input
                            type="text"
                            name="incerteza"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $calibracao['incerteza'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <!-- NOVO PDF -->

                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Substituir Certificado PDF
                        </label>

                        <input
                            type="file"
                            name="certificado_pdf"
                            class="form-control"
                            accept=".pdf,application/pdf"
                        >

                        <?php if (!empty($calibracao['certificado_pdf'])): ?>

                            <div class="form-text">

                                Já existe um certificado cadastrado.

                                <a
                                    href="<?= htmlspecialchars(
                                        $calibracao['certificado_pdf']
                                    ) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Visualizar certificado atual
                                </a>

                            </div>

                        <?php endif; ?>

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
                            $calibracao['observacoes'] ?? ''
                        ) ?></textarea>

                    </div>


                    <!-- STATUS -->
                    <!-- O sistema recalcula automaticamente -->

                    <input
                        type="hidden"
                        name="status_id"
                        value="<?= (int) (
                            $calibracao['status_id'] ?? 1
                        ) ?>"
                    >

                </div>


                <hr>


                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="calibracoes.php?acao=visualizar&id=<?= (int) $calibracao['id'] ?>"
                        class="btn btn-secondary"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-circle"></i>
                        Salvar Alterações
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>