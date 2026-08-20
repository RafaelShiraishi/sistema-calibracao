<?php

$equipamentos = $equipamentos ?? [];

$sucessoEquipamento =
    $sucessoEquipamento ?? null;

$erroEquipamento =
    $erroEquipamento ?? null;

?>

<div class="container-fluid">


    <!-- ====================================================== -->
    <!-- MENSAGENS -->
    <!-- ====================================================== -->

    <?php if ($sucessoEquipamento): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle"></i>

            <?= htmlspecialchars($sucessoEquipamento) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <?php if ($erroEquipamento): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-triangle"></i>

            <?= htmlspecialchars($erroEquipamento) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <!-- ====================================================== -->
    <!-- CABEÇALHO -->
    <!-- ====================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-hdd-stack"></i>

                Equipamentos

            </h2>

            <p class="text-muted mb-0">

                Gerenciamento dos equipamentos cadastrados.

            </p>

        </div>


        <!-- NOVO EQUIPAMENTO -->

        <a
            href="equipamentos.php?acao=novo"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Novo Equipamento

        </a>

    </div>


    <!-- ====================================================== -->
    <!-- FILTRO / PESQUISA -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-8">

                    <label class="form-label">

                        Pesquisar

                    </label>

                    <input
                        type="text"
                        id="pesquisaEquipamento"
                        class="form-control"
                        placeholder="Nome, patrimônio, TAG, modelo ou número de série..."
                    >

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <button
                        type="button"
                        id="limparPesquisa"
                        class="btn btn-outline-secondary w-100"
                    >

                        <i class="bi bi-x-circle"></i>

                        Limpar

                    </button>

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <div class="text-muted small">

                        <?= count($equipamentos) ?>

                        equipamento(s)

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
                                TAG
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Setor
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Situação
                            </th>

                            <th class="text-end">
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody id="tabelaEquipamentos">


                        <?php if (empty($equipamentos)): ?>

                            <tr id="semEquipamentos">

                                <td
                                    colspan="8"
                                    class="text-center text-muted py-5"
                                >

                                    <i
                                        class="bi bi-hdd-stack fs-1 d-block mb-3"
                                    ></i>

                                    Nenhum equipamento cadastrado.

                                </td>

                            </tr>


                        <?php else: ?>


                            <?php foreach (
                                $equipamentos
                                as $equipamento
                            ): ?>

                                <?php

                                $ativo =
                                    (int) (
                                        $equipamento['ativo']
                                        ?? 1
                                    ) === 1;

                                ?>


                                <tr
                                    class="linha-equipamento"
                                >


                                    <!-- EQUIPAMENTO -->

                                    <td>

                                        <strong>

                                            <?= htmlspecialchars(
                                                $equipamento['nome']
                                                ?? '-'
                                            ) ?>

                                        </strong>


                                        <?php if (
                                            !empty(
                                                $equipamento['modelo']
                                            )
                                        ): ?>

                                            <br>

                                            <small class="text-muted">

                                                Modelo:

                                                <?= htmlspecialchars(
                                                    $equipamento['modelo']
                                                ) ?>

                                            </small>

                                        <?php endif; ?>


                                        <?php if (
                                            !empty(
                                                $equipamento['numero_serie']
                                            )
                                        ): ?>

                                            <br>

                                            <small class="text-muted">

                                                Série:

                                                <?= htmlspecialchars(
                                                    $equipamento['numero_serie']
                                                ) ?>

                                            </small>

                                        <?php endif; ?>

                                    </td>


                                    <!-- PATRIMÔNIO -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $equipamento['patrimonio']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- TAG -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $equipamento['tag']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- TIPO -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $equipamento['tipo']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- SETOR -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $equipamento['setor']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        <?php

                                        $statusNome =
                                            $equipamento['status']
                                            ?? '-';

                                        $statusClasse =
                                            'secondary';


                                        if (
                                            mb_strtolower(
                                                $statusNome
                                            )
                                            ===
                                            'ativo'
                                        ) {

                                            $statusClasse =
                                                'success';

                                        } elseif (
                                            stripos(
                                                $statusNome,
                                                'manutenção'
                                            ) !== false
                                        ) {

                                            $statusClasse =
                                                'warning';

                                        } elseif (
                                            stripos(
                                                $statusNome,
                                                'calibração'
                                            ) !== false
                                        ) {

                                            $statusClasse =
                                                'primary';

                                        }

                                        ?>


                                        <span
                                            class="badge text-bg-<?= $statusClasse ?>"
                                        >

                                            <?= htmlspecialchars(
                                                $statusNome
                                            ) ?>

                                        </span>

                                    </td>


                                    <!-- SITUAÇÃO -->

                                    <td>

                                        <?php if ($ativo): ?>

                                            <span
                                                class="badge text-bg-success"
                                            >

                                                <i
                                                    class="bi bi-check-circle"
                                                ></i>

                                                Ativo

                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="badge text-bg-secondary"
                                            >

                                                <i
                                                    class="bi bi-pause-circle"
                                                ></i>

                                                Inativo

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <!-- AÇÕES -->

                                    <td class="text-end">

                                        <div
                                            class="d-flex justify-content-end gap-1"
                                        >


                                            <!-- EDITAR -->

                                            <a
                                                href="equipamentos.php?acao=editar&id=<?= (int) $equipamento['id'] ?>"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Editar equipamento"
                                            >

                                                <i
                                                    class="bi bi-pencil"
                                                ></i>

                                            </a>


                                            <!-- VISUALIZAR -->

                                            <a
                                                href="equipamentos.php?acao=visualizar&id=<?= (int) $equipamento['id'] ?>"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Visualizar equipamento"
                                            >

                                                <i
                                                    class="bi bi-eye"
                                                ></i>

                                            </a>


                                            <!-- ATIVAR / INATIVAR -->

                                            <form
                                                method="POST"
                                                action="equipamentos.php"
                                                class="d-inline"
                                            >

                                                <input
                                                    type="hidden"
                                                    name="acao"
                                                    value="alternar_ativo"
                                                >


                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= (int) $equipamento['id'] ?>"
                                                >


                                                <input
                                                    type="hidden"
                                                    name="ativo"
                                                    value="<?= $ativo ? 0 : 1 ?>"
                                                >


                                                <button
                                                    type="submit"
                                                    class="btn btn-sm <?= $ativo
                                                        ? 'btn-outline-danger'
                                                        : 'btn-outline-success'
                                                    ?>"
                                                    title="<?= $ativo
                                                        ? 'Inativar equipamento'
                                                        : 'Ativar equipamento'
                                                    ?>"
                                                    onclick="return confirm('Deseja realmente <?= $ativo ? 'inativar' : 'ativar' ?> este equipamento?');"
                                                >

                                                    <i
                                                        class="bi <?= $ativo
                                                            ? 'bi-pause-circle'
                                                            : 'bi-play-circle'
                                                        ?>"
                                                    ></i>

                                                </button>

                                            </form>


                                        </div>

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
<!-- PESQUISA -->
<!-- ========================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const pesquisa =
            document.getElementById(
                'pesquisaEquipamento'
            );

        const limpar =
            document.getElementById(
                'limparPesquisa'
            );

        const linhas =
            document.querySelectorAll(
                '.linha-equipamento'
            );


        function filtrar() {

            const texto =
                pesquisa.value
                    .toLowerCase()
                    .trim();


            linhas.forEach(
                function (linha) {

                    const conteudo =
                        linha.textContent
                            .toLowerCase();


                    linha.style.display =
                        (
                            texto === ''
                            ||
                            conteudo.includes(texto)
                        )
                            ? ''
                            : 'none';

                }
            );

        }


        pesquisa.addEventListener(
            'input',
            filtrar
        );


        limpar.addEventListener(
            'click',
            function () {

                pesquisa.value = '';

                filtrar();

            }
        );

    }
);

</script>