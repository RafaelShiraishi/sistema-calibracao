<?php

$tipo = $tipo ?? 'calibracoes';

$dados = $dados ?? [];

$equipamentos = $equipamentos ?? [];
$laboratorios = $laboratorios ?? [];
$setores = $setores ?? [];
$statusEquipamentos = $statusEquipamentos ?? [];

$filtros = $filtros ?? [];

$tipo = $tipo ?? 'calibracoes';
$dados = $dados ?? [];

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-file-earmark-bar-graph"></i>

                Relatórios

            </h2>

            <p class="text-muted mb-0">

                Consulte equipamentos, calibrações e manutenções.

            </p>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- TIPO DE RELATÓRIO -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row g-2">

                <div class="col-md-3">

                    <a
                        href="relatorios.php?tipo=calibracoes"
                        class="btn w-100 <?= $tipo === 'calibracoes'
                            ? 'btn-primary'
                            : 'btn-outline-primary'
                        ?>"
                    >

                        <i class="bi bi-clipboard-check"></i>

                        Calibrações

                    </a>

                </div>


                <div class="col-md-3">

                    <a
                        href="relatorios.php?tipo=calibracoes_vencidas"
                        class="btn w-100 <?= $tipo === 'calibracoes_vencidas'
                            ? 'btn-danger'
                            : 'btn-outline-danger'
                        ?>"
                    >

                        <i class="bi bi-exclamation-triangle"></i>

                        Vencidas

                    </a>

                </div>


                <div class="col-md-3">

                    <a
                        href="relatorios.php?tipo=calibracoes_proximas"
                        class="btn w-100 <?= $tipo === 'calibracoes_proximas'
                            ? 'btn-warning'
                            : 'btn-outline-warning'
                        ?>"
                    >

                        <i class="bi bi-clock"></i>

                        Próximas

                    </a>

                </div>


                <div class="col-md-3">

                    <a
                        href="relatorios.php?tipo=equipamentos"
                        class="btn w-100 <?= $tipo === 'equipamentos'
                            ? 'btn-success'
                            : 'btn-outline-success'
                        ?>"
                    >

                        <i class="bi bi-hdd-stack"></i>

                        Equipamentos

                    </a>

                </div>

            </div>


            <div class="row g-2 mt-1">

                <div class="col-md-3">

                    <a
                        href="relatorios.php?tipo=manutencoes"
                        class="btn w-100 <?= $tipo === 'manutencoes'
                            ? 'btn-secondary'
                            : 'btn-outline-secondary'
                        ?>"
                    >

                        <i class="bi bi-tools"></i>

                        Manutenções

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- FILTROS -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <strong>

                <i class="bi bi-funnel"></i>

                Filtros

            </strong>

        </div>


        <div class="card-body">

            <form
                method="GET"
                action="relatorios.php"
            >

                <input
                    type="hidden"
                    name="tipo"
                    value="<?= htmlspecialchars($tipo) ?>"
                >


                <div class="row g-3">


                    <?php if (
                        in_array(
                            $tipo,
                            [
                                'calibracoes',
                                'calibracoes_vencidas',
                                'calibracoes_proximas',
                                'manutencoes'
                            ],
                            true
                        )
                    ): ?>

                        <div class="col-md-4">

                            <label class="form-label">

                                Equipamento

                            </label>

                            <select
                                name="equipamento_id"
                                class="form-select"
                            >

                                <option value="">
                                    Todos
                                </option>

                                <?php foreach (
                                    $equipamentos
                                    as $equipamento
                                ): ?>

                                    <option
                                        value="<?= (int) $equipamento['id'] ?>"
                                        <?= (
                                            (int) (
                                                $filtros['equipamento_id']
                                                ?? 0
                                            )
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

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    <?php endif; ?>


                    <?php if (
                        in_array(
                            $tipo,
                            [
                                'calibracoes',
                                'calibracoes_vencidas',
                                'calibracoes_proximas'
                            ],
                            true
                        )
                    ): ?>

                        <div class="col-md-4">

                            <label class="form-label">

                                Laboratório

                            </label>

                            <select
                                name="laboratorio_id"
                                class="form-select"
                            >

                                <option value="">
                                    Todos
                                </option>

                                <?php foreach (
                                    $laboratorios
                                    as $laboratorio
                                ): ?>

                                    <option
                                        value="<?= (int) $laboratorio['id'] ?>"
                                        <?= (
                                            (int) (
                                                $filtros['laboratorio_id']
                                                ?? 0
                                            )
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


                        <div class="col-md-4">

                            <label class="form-label">

                                Resultado

                            </label>

                            <select
                                name="resultado"
                                class="form-select"
                            >

                                <option value="">
                                    Todos
                                </option>

                                <option
                                    value="Aprovado"
                                    <?= (
                                        ($filtros['resultado'] ?? '')
                                        ===
                                        'Aprovado'
                                    )
                                        ? 'selected'
                                        : ''
                                    ?>
                                >
                                    Aprovado
                                </option>

                                <option
                                    value="Aprovado com Restrição"
                                    <?= (
                                        ($filtros['resultado'] ?? '')
                                        ===
                                        'Aprovado com Restrição'
                                    )
                                        ? 'selected'
                                        : ''
                                    ?>
                                >
                                    Aprovado com Restrição
                                </option>

                                <option
                                    value="Reprovado"
                                    <?= (
                                        ($filtros['resultado'] ?? '')
                                        ===
                                        'Reprovado'
                                    )
                                        ? 'selected'
                                        : ''
                                    ?>
                                >
                                    Reprovado
                                </option>

                            </select>

                        </div>

                    <?php endif; ?>


                    <?php if (
                        $tipo === 'equipamentos'
                    ): ?>

                        <div class="col-md-6">

                            <label class="form-label">

                                Setor

                            </label>

                            <select
                                name="setor_id"
                                class="form-select"
                            >

                                <option value="">
                                    Todos
                                </option>

                                <?php foreach (
                                    $setores
                                    as $setor
                                ): ?>

                                    <option
                                        value="<?= (int) $setor['id'] ?>"
                                        <?= (
                                            (int) (
                                                $filtros['setor_id']
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


                        <div class="col-md-6">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status_id"
                                class="form-select"
                            >

                                <option value="">
                                    Todos
                                </option>

                                <?php foreach (
                                    $statusEquipamentos
                                    as $status
                                ): ?>

                                    <option
                                        value="<?= (int) $status['id'] ?>"
                                        <?= (
                                            (int) (
                                                $filtros['status_id']
                                                ?? 0
                                            )
                                            ===
                                            (int) $status['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $status['nome']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    <?php endif; ?>


                    <?php if (
                        in_array(
                            $tipo,
                            [
                                'calibracoes',
                                'manutencoes'
                            ],
                            true
                        )
                    ): ?>

                        <div class="col-md-3">

                            <label class="form-label">
                                Data inicial
                            </label>

                            <input
                                type="date"
                                name="data_inicio"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $filtros['data_inicio']
                                    ?? ''
                                ) ?>"
                            >

                        </div>


                        <div class="col-md-3">

                            <label class="form-label">
                                Data final
                            </label>

                            <input
                                type="date"
                                name="data_fim"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $filtros['data_fim']
                                    ?? ''
                                ) ?>"
                            >

                        </div>

                    <?php endif; ?>


                    <div class="col-12">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-search"></i>

                            Gerar Relatório

                        </button>

                        <a
                            href="relatorios.php?tipo=<?= urlencode($tipo) ?>"
                            class="btn btn-outline-secondary"
                        >

                            Limpar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <!-- ====================================================== -->
    <!-- RESULTADO -->
    <!-- ====================================================== -->

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <strong>

                <?= count($dados) ?>

                registro(s) encontrado(s)

            </strong>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <?php if (
                            $tipo === 'equipamentos'
                        ): ?>

                            <tr>

                                <th>Equipamento</th>
                                <th>Patrimônio</th>
                                <th>TAG</th>
                                <th>Setor</th>
                                <th>Status</th>
                                <th>Fabricante</th>
                                <th>Tipo</th>

                            </tr>

                        <?php elseif (
                            $tipo === 'manutencoes'
                        ): ?>

                            <tr>

                                <th>Data</th>
                                <th>Equipamento</th>
                                <th>Patrimônio</th>
                                <th>Descrição</th>
                                <th>Usuário</th>
                                <th>Observações</th>

                            </tr>

                        <?php else: ?>

                            <tr>

                                <th>Equipamento</th>
                                <th>Certificado</th>
                                <th>Laboratório</th>
                                <th>Data</th>
                                <th>Validade</th>
                                <th>Resultado</th>
                                <th>Status</th>

                            </tr>

                        <?php endif; ?>

                    </thead>


                    <tbody>

                        <?php if (empty($dados)): ?>

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-muted py-5"
                                >

                                    Nenhum registro encontrado.

                                </td>

                            </tr>

                        <?php else: ?>


                            <?php foreach ($dados as $registro): ?>

                                <?php if (
                                    $tipo === 'equipamentos'
                                ): ?>

                                    <tr>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['nome']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['patrimonio']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['tag'] ?? '-'
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['setor'] ?? '-'
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['status'] ?? '-'
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['fabricante']
                                                ?? '-'
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['tipo'] ?? '-'
                                            ) ?>

                                        </td>

                                    </tr>

                                <?php elseif (
                                    $tipo === 'manutencoes'
                                ): ?>

                                    <tr>

                                        <td>

                                            <?= !empty(
                                                $registro['data_manutencao']
                                            )
                                                ? date(
                                                    'd/m/Y',
                                                    strtotime(
                                                        $registro['data_manutencao']
                                                    )
                                                )
                                                : '-'
                                            ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['equipamento']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['patrimonio']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['descricao']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['usuario']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= nl2br(
                                                htmlspecialchars(
                                                    $registro['observacoes']
                                                    ?? '-'
                                                )
                                            ) ?>

                                        </td>

                                    </tr>

                                <?php else: ?>

                                    <tr>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['equipamento']
                                            ) ?>

                                            <br>

                                            <small class="text-muted">

                                                <?= htmlspecialchars(
                                                    $registro['patrimonio']
                                                ) ?>

                                            </small>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro[
                                                    'numero_certificado'
                                                ]
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['laboratorio']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= !empty(
                                                $registro[
                                                    'data_calibracao'
                                                ]
                                            )
                                                ? date(
                                                    'd/m/Y',
                                                    strtotime(
                                                        $registro[
                                                            'data_calibracao'
                                                        ]
                                                    )
                                                )
                                                : '-'
                                            ?>

                                        </td>

                                        <td>

                                            <?= !empty(
                                                $registro[
                                                    'data_validade'
                                                ]
                                            )
                                                ? date(
                                                    'd/m/Y',
                                                    strtotime(
                                                        $registro[
                                                            'data_validade'
                                                        ]
                                                    )
                                                )
                                                : '-'
                                            ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['resultado']
                                            ) ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars(
                                                $registro['status']
                                            ) ?>

                                        </td>

                                    </tr>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>