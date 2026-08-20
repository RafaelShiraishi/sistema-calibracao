<?php

$fabricantes = $fabricantes ?? [];
$tipos        = $tipos ?? [];
$setores      = $setores ?? [];
$usuarios     = $usuarios ?? [];
$empresas     = $empresas ?? [];
$status       = $status ?? [];

?>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Patrimônio *</label>
        <input
            type="text"
            name="patrimonio"
            class="form-control"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">TAG *</label>
        <input
            type="text"
            name="tag"
            class="form-control"
            required>
    </div>

    <div class="col-md-8 mb-3">
        <label class="form-label">Nome do Equipamento *</label>
        <input
            type="text"
            name="nome"
            class="form-control"
            required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Modelo</label>
        <input
            type="text"
            name="modelo"
            class="form-control">
    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Fabricante *</label>

        <select
            name="fabricante"
            class="form-select"
            required>

            <option value="">Selecione...</option>

            <?php foreach ($fabricantes as $f): ?>

                <option value="<?= $f['id'] ?>">
                    <?= htmlspecialchars($f['nome']) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Tipo de Equipamento *</label>

        <select
            name="tipo"
            class="form-select"
            required>

            <option value="">Selecione...</option>

            <?php foreach ($tipos as $t): ?>

                <option value="<?= $t['id'] ?>">
                    <?= htmlspecialchars($t['nome']) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Número de Série</label>
        <input
            type="text"
            name="serie"
            class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Faixa de Medição</label>
        <input
            type="text"
            name="faixa"
            class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Resolução</label>
        <input
            type="text"
            name="resolucao"
            class="form-control">
    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Setor *</label>

        <select
            name="setor"
            class="form-select"
            required>

            <option value="">Selecione...</option>

            <?php foreach ($setores as $s): ?>

                <option value="<?= $s['id'] ?>">
                    <?= htmlspecialchars($s['nome']) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Responsável *</label>

        <select
            name="responsavel"
            class="form-select"
            required>

            <option value="">Selecione...</option>

            <?php foreach ($usuarios as $u): ?>

                <option value="<?= $u['id'] ?>">
                    <?= htmlspecialchars($u['nome']) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Empresa *</label>

        <select
            name="empresa"
            class="form-select"
            required>

            <option value="">Selecione...</option>

            <?php foreach ($empresas as $e): ?>

                <option value="<?= $e['id'] ?>">
                    <?= htmlspecialchars($e['razao_social']) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Status *</label>

        <select
            name="status"
            class="form-select"
            required>

            <option value="">Selecione...</option>

            <?php foreach ($status as $st): ?>

                <option value="<?= $st['id'] ?>">
                    <?= htmlspecialchars($st['nome']) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Localização</label>
        <input
            type="text"
            name="localizacao"
            class="form-control">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Data de Aquisição</label>
        <input
            type="date"
            name="data"
            class="form-control">
    </div>

    <div class="col-12 mb-3">

        <label class="form-label">Observações</label>

        <textarea
            name="observacoes"
            rows="5"
            class="form-control"></textarea>

    </div>

</div>