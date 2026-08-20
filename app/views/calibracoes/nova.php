<?php

$equipamentos = $equipamentos ?? [];
$laboratorios = $laboratorios ?? [];
$usuarios = $usuarios ?? [];
$status = $status ?? [];

$equipamentoSelecionado =
    $equipamentoSelecionado ?? 0;

$erro =
    $_SESSION['erro_calibracao']
    ?? null;

unset(
    $_SESSION['erro_calibracao']
);

?>

<div class="container-fluid">

    <!-- ====================================================== -->
    <!-- CABEÇALHO -->
    <!-- ====================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                <i class="bi bi-clipboard-plus"></i>
                Nova Calibração
            </h2>

            <p class="text-muted mb-0">
                Cadastre uma nova calibração para um equipamento.
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


    <!-- ====================================================== -->
    <!-- ERRO -->
    <!-- ====================================================== -->

    <?php if ($erro): ?>

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-triangle"></i>

            <?= htmlspecialchars($erro) ?>

        </div>

    <?php endif; ?>


    <!-- ====================================================== -->
    <!-- FORMULÁRIO -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="alert alert-info">

                <strong>

                    <i class="bi bi-info-circle"></i>

                    Dados da Calibração

                </strong>

                <br>

                Informe os dados do certificado e do procedimento
                de calibração realizado.

            </div>


            <form
                method="POST"
                action="calibracoes.php"
                enctype="multipart/form-data"
            >

                <input
                    type="hidden"
                    name="acao"
                    value="novo"
                >


                <div class="row">


                    <!-- ================================================== -->
                    <!-- EQUIPAMENTO -->
                    <!-- ================================================== -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Equipamento
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="equipamento_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Selecione...
                            </option>


                            <?php foreach (
                                $equipamentos
                                as $equipamento
                            ): ?>

                                <option
                                    value="<?= (int) $equipamento['id'] ?>"
                                    <?= (
                                        (int) $equipamentoSelecionado
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


                    <!-- ================================================== -->
                    <!-- LABORATÓRIO -->
                    <!-- ================================================== -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Laboratório
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="laboratorio_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Selecione...
                            </option>


                            <?php foreach (
                                $laboratorios
                                as $laboratorio
                            ): ?>

                                <option
                                    value="<?= (int) $laboratorio['id'] ?>"
                                >

                                    <?= htmlspecialchars(
                                        $laboratorio['nome']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- ================================================== -->
                    <!-- CERTIFICADO -->
                    <!-- ================================================== -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Número do Certificado
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="numero_certificado"
                            class="form-control"
                            required
                        >

                    </div>


                    <!-- ================================================== -->
                    <!-- RESULTADO -->
                    <!-- ================================================== -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Resultado
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="resultado"
                            class="form-select"
                            required
                        >

                            <option value="Aprovado">
                                Aprovado
                            </option>

                            <option value="Aprovado com Restrição">
                                Aprovado com Restrição
                            </option>

                            <option value="Reprovado">
                                Reprovado
                            </option>

                        </select>

                    </div>


                    <!-- ================================================== -->
                    <!-- DATA CALIBRAÇÃO -->
                    <!-- ================================================== -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Data da Calibração
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            name="data_calibracao"
                            class="form-control"
                            required
                        >

                    </div>


                    <!-- ================================================== -->
                    <!-- DATA VALIDADE -->
                    <!-- ================================================== -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Data de Validade
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            name="data_validade"
                            class="form-control"
                            required
                        >

                    </div>


                    <!-- ================================================== -->
                    <!-- INCERTEZA -->
                    <!-- ================================================== -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Incerteza de Medição

                        </label>

                        <input
                            type="text"
                            name="incerteza"
                            class="form-control"
                            placeholder="Ex.: ± 0,05 mm"
                        >

                    </div>


                    <!-- ================================================== -->
                    <!-- PDF -->
                    <!-- ================================================== -->

                    <div class="col-12 mb-3">

                        <label class="form-label">

                            Certificado (PDF)

                        </label>

                        <input
                            type="file"
                            name="certificado_pdf"
                            class="form-control"
                            accept=".pdf,application/pdf"
                        >

                        <div class="form-text">

                            PDF de até 10 MB.

                        </div>

                    </div>


                    <!-- ================================================== -->
                    <!-- OBSERVAÇÕES -->
                    <!-- ================================================== -->

                    <div class="col-12 mb-3">

                        <label class="form-label">

                            Observações

                        </label>

                        <textarea
                            name="observacoes"
                            rows="5"
                            class="form-control"
                            placeholder="Digite observações sobre a calibração..."
                        ></textarea>

                    </div>

                </div>


                <hr>


                <!-- ================================================== -->
                <!-- BOTÕES -->
                <!-- ================================================== -->

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="calibracoes.php"
                        class="btn btn-secondary"
                    >

                        <i class="bi bi-x-circle"></i>

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-check-circle"></i>

                        Salvar Calibração

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>