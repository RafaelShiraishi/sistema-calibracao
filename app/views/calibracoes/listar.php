<?php

$hoje = $hoje ?? new DateTime('today');

$totalCalibracoes = $totalCalibracoes ?? 0;
$totalAprovadas = $totalAprovadas ?? 0;
$totalRestricoes = $totalRestricoes ?? 0;
$totalReprovadas = $totalReprovadas ?? 0;
$totalVencidas = $totalVencidas ?? 0;

$sucessoCalibracao = $sucessoCalibracao ?? null;
$erroCalibracao = $erroCalibracao ?? null;

?>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                <i class="bi bi-clipboard2-check"></i>
                Calibrações
            </h2>

            <p class="text-muted mb-0">
                Gerenciamento das calibrações dos equipamentos.
            </p>

        </div>

        <div>

            <a
                href="calibracoes.php?acao=novo   "
                class="btn btn-primary"
            >

                <i class="bi bi-plus-circle"></i>

                Nova Calibração

            </a>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- INDICADORES -->
    <!-- ====================================================== -->

    <div class="row g-3 mb-4">


        <!-- TOTAL -->

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="text-muted mb-1">
                        Total de Calibrações
                    </div>

                    <h2 class="mb-0">
                        <?= $totalCalibracoes ?>
                    </h2>

                </div>

            </div>

        </div>


        <!-- APROVADAS -->

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="text-muted mb-1">
                        Aprovadas
                    </div>

                    <h2 class="mb-0 text-success">
                        <?= $totalAprovadas ?>
                    </h2>

                </div>

            </div>

        </div>


        <!-- RESTRIÇÕES -->

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="text-muted mb-1">
                        Com Restrição
                    </div>

                    <h2 class="mb-0 text-warning">
                        <?= $totalRestricoes ?>
                    </h2>

                </div>

            </div>

        </div>


        <!-- VENCIDAS -->

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="text-muted mb-1">
                        Vencidas
                    </div>

                    <h2 class="mb-0 text-danger">
                        <?= $totalVencidas ?>
                    </h2>

                </div>

            </div>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- FILTROS -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row g-3">


                <div class="col-md-5">

                    <label class="form-label">
                        Pesquisar
                    </label>

                    <input
                        type="text"
                        id="pesquisaCalibracao"
                        class="form-control"
                        placeholder="Equipamento, patrimônio ou certificado..."
                    >

                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        Resultado
                    </label>

                    <select
                        id="filtroResultado"
                        class="form-select"
                    >

                        <option value="">
                            Todos
                        </option>

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


                <div class="col-md-2 d-flex align-items-end">

                    <button
                        type="button"
                        id="limparFiltros"
                        class="btn btn-outline-secondary w-100"
                    >

                        <i class="bi bi-x-circle"></i>

                        Limpar

                    </button>

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <div class="text-muted small">

                        <?= $totalReprovadas ?>

                        reprovada(s)

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- TABELA -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>
                                Equipamento
                            </th>

                            <th>
                                Patrimônio
                            </th>

                            <th>
                                Certificado
                            </th>

                            <th>
                                Laboratório
                            </th>

                            <th>
                                Data
                            </th>

                            <th>
                                Validade
                            </th>

                            <th>
                                Resultado
                            </th>

                            <th>
                                Situação
                            </th>

                        </tr>

                    </thead>

                    <tbody id="tabelaCalibracoes">


                    <?php if (empty($calibracoes)): ?>

                        <tr id="semResultados">

                            <td
                                colspan="8"
                                class="text-center text-muted py-5"
                            >

                                <i
                                    class="bi bi-clipboard-x fs-1 d-block mb-3"
                                ></i>

                                Nenhuma calibração cadastrada.

                            </td>

                        </tr>


                    <?php else: ?>


                        <?php foreach ($calibracoes as $calibracao): ?>


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


                            $vencida =
                                !empty($calibracao['data_validade'])
                                && $calibracao['data_validade'] < $hoje;


                            ?>


                            <tr
                                class="linha-calibracao"
                                data-resultado="<?= htmlspecialchars($resultado) ?>"
                            >

                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $calibracao['equipamento']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                    <?php if (!empty($calibracao['tag'])): ?>

                                        <br>

                                        <small class="text-muted">

                                            TAG:

                                            <?= htmlspecialchars(
                                                $calibracao['tag']
                                            ) ?>

                                        </small>

                                    <?php endif; ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $calibracao['patrimonio']
                                        ?? '-'
                                    ) ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $calibracao['numero_certificado']
                                        ?? '-'
                                    ) ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $calibracao['laboratorio']
                                        ?? '-'
                                    ) ?>

                                </td>


                                <td>

                                    <?php

                                    if (
                                        !empty(
                                            $calibracao['data_calibracao']
                                        )
                                    ) {

                                        echo date(
                                            'd/m/Y',
                                            strtotime(
                                                $calibracao['data_calibracao']
                                            )
                                        );

                                    } else {

                                        echo '-';

                                    }

                                    ?>

                                </td>


                                <td>

                                    <?php

                                    if (
                                        !empty(
                                            $calibracao['data_validade']
                                        )
                                    ) {

                                        echo date(
                                            'd/m/Y',
                                            strtotime(
                                                $calibracao['data_validade']
                                            )
                                        );

                                    } else {

                                        echo '-';

                                    }

                                    ?>

                                </td>


                                <td>

                                    <span
                                        class="badge text-bg-<?= $classeResultado ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $resultado
                                        ) ?>

                                    </span>

                                </td>


                                <td>

                                    <?php if ($vencida): ?>

                                        <span
                                            class="badge text-bg-danger"
                                        >

                                            <i class="bi bi-exclamation-triangle"></i>

                                            Vencida

                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="badge text-bg-success"
                                        >

                                            <i class="bi bi-check-circle"></i>

                                            Dentro da validade

                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>


                        <?php endforeach; ?>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- ========================================================== -->
<!-- FILTROS DA TABELA -->
<!-- ========================================================== -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const pesquisa =
        document.getElementById('pesquisaCalibracao');

    const filtroResultado =
        document.getElementById('filtroResultado');

    const limpar =
        document.getElementById('limparFiltros');

    const linhas =
        document.querySelectorAll('.linha-calibracao');


    function filtrar() {

        const texto =
            pesquisa.value
                .toLowerCase()
                .trim();

        const resultado =
            filtroResultado.value;


        linhas.forEach(function (linha) {

            const conteudo =
                linha.textContent
                    .toLowerCase();

            const resultadoLinha =
                linha.dataset.resultado;


            const correspondeTexto =
                texto === ''
                || conteudo.includes(texto);


            const correspondeResultado =
                resultado === ''
                || resultadoLinha === resultado;


            if (
                correspondeTexto
                && correspondeResultado
            ) {

                linha.style.display = '';

            } else {

                linha.style.display = 'none';

            }

        });

    }


    pesquisa.addEventListener(
        'input',
        filtrar
    );


    filtroResultado.addEventListener(
        'change',
        filtrar
    );


    limpar.addEventListener(
        'click',
        function () {

            pesquisa.value = '';

            filtroResultado.value = '';

            filtrar();

        }
    );

});

</script>