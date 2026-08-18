<?php

$equipamento = $equipamento ?? [];

$fabricantes = $fabricantes ?? [];

$tipos = $tipos ?? [];

$setores = $setores ?? [];

$usuarios = $usuarios ?? [];

$empresas = $empresas ?? [];

$status = $status ?? [];

?>

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h5 class="mb-1">

            <i class="bi bi-pencil-square"></i>

            Editar Equipamento

        </h5>

        <small class="text-muted">

            Altere os dados do equipamento abaixo.

        </small>

    </div>


    <div class="card-body">

        <form
            method="POST"
            action="equipamentos.php"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                name="id"
                value="<?= (int) ($equipamento['id'] ?? 0) ?>"
            >


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
                        value="<?= htmlspecialchars(
                            $equipamento['patrimonio'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
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
                        value="<?= htmlspecialchars(
                            $equipamento['tag'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
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
                        value="<?= htmlspecialchars(
                            $equipamento['nome'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
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
                        value="<?= htmlspecialchars(
                            $equipamento['modelo'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >

                </div>


                <!-- FABRICANTE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Fabricante

                    </label>

                    <select
                        name="fabricante"
                        class="form-select"
                    >

                        <option value="">

                            Selecione...

                        </option>


                        <?php foreach ($fabricantes as $f): ?>

                            <option
                                value="<?= (int) $f['id'] ?>"
                                <?= (
                                    (int) ($equipamento['fabricante_id'] ?? 0)
                                    ===
                                    (int) $f['id']
                                ) ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars(
                                    $f['nome'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- TIPO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Tipo de Equipamento

                    </label>

                    <select
                        name="tipo"
                        class="form-select"
                    >

                        <option value="">

                            Selecione...

                        </option>


                        <?php foreach ($tipos as $t): ?>

                            <option
                                value="<?= (int) $t['id'] ?>"
                                <?= (
                                    (int) ($equipamento['tipo_id'] ?? 0)
                                    ===
                                    (int) $t['id']
                                ) ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars(
                                    $t['nome'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
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
                        value="<?= htmlspecialchars(
                            $equipamento['numero_serie'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >

                </div>


                <!-- FAIXA DE MEDIÇÃO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Faixa de Medição

                    </label>

                    <input
                        type="text"
                        name="faixa"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $equipamento['faixa_medicao'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
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
                        value="<?= htmlspecialchars(
                            $equipamento['resolucao'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >

                </div>


                <!-- SETOR -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Setor

                    </label>

                    <select
                        name="setor"
                        class="form-select"
                    >

                        <option value="">

                            Selecione...

                        </option>


                        <?php foreach ($setores as $s): ?>

                            <option
                                value="<?= (int) $s['id'] ?>"
                                <?= (
                                    (int) ($equipamento['setor_id'] ?? 0)
                                    ===
                                    (int) $s['id']
                                ) ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars(
                                    $s['nome'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- RESPONSÁVEL -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Responsável

                    </label>

                    <select
                        name="responsavel"
                        class="form-select"
                    >

                        <option value="">

                            Selecione...

                        </option>


                        <?php foreach ($usuarios as $u): ?>

                            <option
                                value="<?= (int) $u['id'] ?>"
                                <?= (
                                    (int) ($equipamento['responsavel_id'] ?? 0)
                                    ===
                                    (int) $u['id']
                                ) ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars(
                                    $u['nome'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- EMPRESA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Empresa

                    </label>

                    <select
                        name="empresa"
                        class="form-select"
                    >

                        <option value="">

                            Selecione...

                        </option>


                        <?php foreach ($empresas as $e): ?>

                            <option
                                value="<?= (int) $e['id'] ?>"
                                <?= (
                                    (int) ($equipamento['empresa_id'] ?? 0)
                                    ===
                                    (int) $e['id']
                                ) ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars(
                                    $e['razao_social'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="">

                            Selecione...

                        </option>


                        <?php foreach ($status as $st): ?>

                            <option
                                value="<?= (int) $st['id'] ?>"
                                <?= (
                                    (int) ($equipamento['status_id'] ?? 0)
                                    ===
                                    (int) $st['id']
                                ) ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars(
                                    $st['nome'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
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
                        value="<?= htmlspecialchars(
                            $equipamento['localizacao'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
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
                            $equipamento['data_aquisicao'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >

                </div>


                <!-- OBSERVAÇÕES -->

                <div class="col-12 mb-3">

                    <label class="form-label">

                        Observações

                    </label>

                    <textarea
                        name="obs"
                        rows="5"
                        class="form-control"
                    ><?= htmlspecialchars(
                        $equipamento['observacoes'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?></textarea>

                </div>


            </div>


            <hr>


            <!-- BOTÕES -->

            <button
                type="submit"
                class="btn btn-success"
            >

                <i class="bi bi-check-circle"></i>

                Salvar Alterações

            </button>


            <a
                href="equipamentos.php?acao=visualizar&id=<?= (int) ($equipamento['id'] ?? 0) ?>"
                class="btn btn-secondary"
            >

                Cancelar

            </a>


        </form>

    </div>

</div>