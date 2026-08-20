<?php

$historico = $historico ?? [];

?>

<div class="card border-0 shadow-sm">

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

                Nenhum evento registrado para este equipamento.

            </div>

        <?php else: ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Descrição</th>
                            <th>Usuário</th>
                            <th>Observações</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($historico as $evento): ?>

                            <tr>

                                <td>

                                    <?= !empty($evento['data_evento'])
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
                                        ($evento['tipo_evento'] ?? '')
                                        === 'Calibração'
                                    ): ?>

                                        <span class="badge text-bg-primary">

                                            <i class="bi bi-clipboard-check"></i>

                                            Calibração

                                        </span>

                                    <?php elseif (
                                        ($evento['tipo_evento'] ?? '')
                                        === 'Manutenção'
                                    ): ?>

                                        <span class="badge text-bg-warning">

                                            <i class="bi bi-tools"></i>

                                            Manutenção

                                        </span>

                                    <?php else: ?>

                                        <span class="badge text-bg-secondary">

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