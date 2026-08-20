<div class="container-fluid">

    <?php if (!empty($sucessoLaboratorio)): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle"></i>

            <?= htmlspecialchars($sucessoLaboratorio) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <?php if (!empty($erroLaboratorio)): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-triangle"></i>

            <?= htmlspecialchars($erroLaboratorio) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-building"></i>

                Laboratórios

            </h2>

            <p class="text-muted mb-0">

                Gerenciamento dos laboratórios de calibração.

            </p>

        </div>


        <a
            href="laboratorios.php?acao=novo"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Novo Laboratório

        </a>

    </div>


    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>Contato</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Cidade/UF</th>
                            <th>Status</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (empty($laboratorios)): ?>

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-muted py-5"
                                >

                                    Nenhum laboratório cadastrado.

                                </td>

                            </tr>

                        <?php else: ?>

                            <?php foreach ($laboratorios as $laboratorio): ?>

                                <tr>

                                    <td>

                                        <strong>

                                            <?= htmlspecialchars(
                                                $laboratorio['nome']
                                            ) ?>

                                        </strong>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $laboratorio['cnpj']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $laboratorio['contato']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $laboratorio['telefone']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $laboratorio['email']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $laboratorio['cidade']
                                            ?? '-'
                                        ) ?>

                                        <?php if (
                                            !empty(
                                                $laboratorio['estado']
                                            )
                                        ): ?>

                                            /

                                            <?= htmlspecialchars(
                                                $laboratorio['estado']
                                            ) ?>

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <?php if (
                                            (int) $laboratorio['ativo'] === 1
                                        ): ?>

                                            <span
                                                class="badge text-bg-success"
                                            >

                                                Ativo

                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="badge text-bg-secondary"
                                            >

                                                Inativo

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <div class="d-flex gap-1">

                                            <a
                                                href="laboratorios.php?acao=editar&id=<?= (int) $laboratorio['id'] ?>"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Editar"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            <form
                                                method="POST"
                                                action="laboratorios.php"
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
                                                    value="<?= (int) $laboratorio['id'] ?>"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="ativo"
                                                    value="<?= (int) $laboratorio['ativo'] === 1 ? 0 : 1 ?>"
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm <?= (int) $laboratorio['ativo'] === 1
                                                        ? 'btn-outline-danger'
                                                        : 'btn-outline-success'
                                                    ?>"
                                                    title="<?= (int) $laboratorio['ativo'] === 1
                                                        ? 'Inativar'
                                                        : 'Ativar'
                                                    ?>"
                                                    onclick="return confirm('Deseja realmente alterar o status deste laboratório?');"
                                                >

                                                    <i
                                                        class="bi <?= (int) $laboratorio['ativo'] === 1
                                                            ? 'bi-x-circle'
                                                            : 'bi-check-circle'
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